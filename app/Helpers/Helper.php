<?php

use App\Models\Shield\Permission;
use App\Repositories\MenuRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

if (!function_exists('isMenuActive')) {
    /**
     * Cek apakah menu sedang aktif
     *
     * @param string $url
     * @return bool
     */
    function isMenuActive($url)
    {
        if (!$url) {
            return false;
        }

        $currentUrl = request()->path();
        $currentRoute = request()->route()?->getName();

        // Cek apakah URL adalah route name
        if (Route::has($url)) {
            return $currentRoute === $url;
        }

        // Cek apakah URL match dengan current path
        return str_starts_with($currentUrl, trim($url, '/'));
    }
}

if (!function_exists('getMenuUrl')) {
    /**
     * Get URL dari menu (support route name & path)
     *
     * @param string $url
     * @return string
     */
    function getMenuUrl($url)
    {
        if (!$url) {
            return '#';
        }

        // Cek apakah URL adalah route name
        if (Route::has($url)) {
            return route($url);
        }

        // Return URL biasa
        return url($url);
    }
}

if (!function_exists('urlMenu')) {
    /**
     * Ambil semua URL menu yang terdaftar (untuk validasi permission)
     * Hanya Menu saja (tidak termasuk SubMenu/ChildMenu)
     *
     * @return array
     */
    function urlMenu()
    {
        return Cache::remember('all_menu_urls', now()->addDay(), function () {
            $urls = [];
            $menus = (new MenuRepository())->getMenus(); // tanpa filter permission

            foreach ($menus as $menu) {
                if (!empty($menu->url)) {
                    $urls[] = $menu->url;
                }
            }

            return $urls;
        });
    }
}

if (!function_exists('menus')) {
    /**
     * Ambil menu yang sudah difilter berdasarkan permission user
     * Cache per user + cache global menu structure
     *
     * @return \Illuminate\Support\Collection
     */
    function menus()
    {
        $user = Auth::user();
        $userId = $user?->id ?? 'guest';
        $cacheKey = "menus_user_{$userId}";

        // Static memory cache untuk menghindari query berulang dalam 1 request
        static $menuCacheMemory = [];

        if (isset($menuCacheMemory[$cacheKey])) {
            return $menuCacheMemory[$cacheKey];
        }

        // Ambil dari cache (jika ada)
        if (Cache::has($cacheKey)) {
            return $menuCacheMemory[$cacheKey] = Cache::get($cacheKey);
        }

        // Cache global menu structure (tanpa filter permission)
        $globalMenu = Cache::remember('menu_structure_global', now()->addDay(), function () {
            return (new MenuRepository())
                ->getMenus()
                ->where('active', 1) // Hanya menu aktif
                ->groupBy('category');
        });

        // Cache permission user
        $permissions = cachedUserPermissions($user);

        // Filter menu berdasarkan permission user
        $filtered = $globalMenu->map(function ($group) use ($user, $permissions) {
            return $group->filter(function ($menu) use ($user, $permissions) {
                // Check permission "read {menu->url}"
                if (!userHasMenuPermission($menu, $user, $permissions)) {
                    return false;
                }

                // Check apakah menu aktif
                if ($menu->active == 0) {
                    return false;
                }

                return true;
            })->values(); // Reset array keys
        })->filter(function ($group) {
            return $group->isNotEmpty(); // Hapus kategori kosong
        });

        // Simpan ke cache
        Cache::put($cacheKey, $filtered, now()->addDay());

        return $menuCacheMemory[$cacheKey] = $filtered;
    }
}

if (!function_exists('menuPermissions')) {
    /**
     * Ambil semua menu dengan permission (untuk management/settings)
     *
     * @return \Illuminate\Support\Collection
     */
    function menuPermissions()
    {
        $user = Auth::user();
        $userId = $user?->id ?? 'guest';
        $cacheKey = "menu_permissions_user_{$userId}";

        return Cache::remember($cacheKey, now()->addDay(), function () {
            return (new MenuRepository())
                ->getMenus()
                ->sortBy('orders');
        });
    }
}

if (!function_exists('userHasMenuPermission')) {
    /**
     * Cek apakah user punya izin untuk akses menu tertentu
     * Permission yang dicek: "read {menu->url}"
     *
     * @param  mixed  $menu  Menu model
     * @param  \App\Models\User|null  $user
     * @param  array|null  $permissions  Cached permissions
     * @return bool
     */
    function userHasMenuPermission($menu, $user = null, $permissions = null)
    {
        // Jika user tidak login
        if (!$user) {
            return false;
        }

        // Jika menu tidak punya URL, anggap bisa diakses (menu kategori/header)
        if (empty($menu->url)) {
            return true;
        }

        // Format permission name: "read {url}"
        $permissionName = "read " . $menu->url;

        // Ambil cached permissions jika belum ada
        $permissions = $permissions ?? cachedUserPermissions($user);

        // Cek permission langsung
        $hasDirect = in_array($permissionName, $permissions['direct'] ?? []);

        // Cek permission dari role
        $hasRole = in_array($permissionName, $permissions['role'] ?? []);

        return $hasDirect || $hasRole;
    }
}

if (!function_exists('userHasMenuAction')) {
    /**
     * Cek apakah user punya izin untuk action tertentu pada menu
     * Action: create, read, update, delete, activate
     *
     * @param  mixed  $menu  Menu model
     * @param  string  $action  create|read|update|delete|activate
     * @param  \App\Models\User|null  $user
     * @param  array|null  $permissions  Cached permissions
     * @return bool
     */
    function userHasMenuAction($menu, string $action, $user = null, $permissions = null)
    {
        // Jika user tidak login
        if (!$user) {
            return false;
        }

        // Jika menu tidak punya URL
        if (empty($menu->url)) {
            return false;
        }

        // Validasi action
        $validActions = ['create', 'read', 'update', 'delete', 'activate'];
        if (!in_array($action, $validActions)) {
            return false;
        }

        // Format permission name: "{action} {url}"
        // Contoh: "create admin/users", "activate admin/users"
        $permissionName = "{$action} " . $menu->url;

        // Ambil cached permissions jika belum ada
        $permissions = $permissions ?? cachedUserPermissions($user);

        // Cek permission langsung
        $hasDirect = in_array($permissionName, $permissions['direct'] ?? []);

        // Cek permission dari role
        $hasRole = in_array($permissionName, $permissions['role'] ?? []);

        return $hasDirect || $hasRole;
    }
}

if (!function_exists('permissionWithoutMenu')) {
    /**
     * Ambil permission yang tidak terkait dengan menu apapun
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function permissionWithoutMenu()
    {
        return Cache::remember('permissions_without_menu', now()->addDay(), function () {
            return Permission::query()
                ->whereDoesntHave('menus')
                ->get();
        });
    }
}

if (!function_exists('cachedUserPermissions')) {
    /**
     * Cache permission user (langsung + dari role)
     * Menggunakan static cache + Laravel cache
     *
     * @param  \App\Models\User|null  $user
     * @return array ['direct' => [], 'role' => []]
     */
    function cachedUserPermissions($user)
    {
        // Static cache dalam 1 request
        static $cachedPermissions = [];

        if (!$user) {
            return ['direct' => [], 'role' => []];
        }

        // Jika sudah ada di static cache
        if (isset($cachedPermissions[$user->id])) {
            return $cachedPermissions[$user->id];
        }

        $cacheKey = "permissions_user_{$user->id}";

        // Ambil dari Laravel cache atau query database
        return $cachedPermissions[$user->id] = Cache::remember($cacheKey, now()->addDay(), function () use ($user) {
            // Eager load untuk menghindari N+1 query
            $user->loadMissing(['permissions', 'roles.permissions']);

            return [
                'direct' => $user->permissions->pluck('name')->toArray(),
                'role'   => $user->roles->flatMap->permissions->pluck('name')->unique()->toArray(),
            ];
        });
    }
}

if (!function_exists('forgetCachedUserPermissions')) {
    /**
     * Hapus cache permission user
     * Dipakai setelah ubah role/permission user
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    function forgetCachedUserPermissions($user)
    {
        if (!$user) {
            return;
        }

        // Hapus cache permission
        Cache::forget("permissions_user_{$user->id}");

        // Hapus cache menu user
        Cache::forget("menus_user_{$user->id}");
    }
}

if (!function_exists('forgetAllMenuCache')) {
    /**
     * Hapus semua cache terkait menu
     * Dipakai setelah update menu, permission, atau role
     *
     * @return void
     */
    function forgetAllMenuCache()
    {
        // Hapus cache global menu
        Cache::forget('menu_structure_global');
        Cache::forget('all_menu_urls');
        Cache::forget('permissions_without_menu');

        // Hapus cache menu per user (jika perlu, bisa loop semua user)
        // Atau gunakan tag cache jika driver support (redis/memcached)
    }
}

if (!function_exists('refreshMenuCache')) {
    /**
     * Refresh cache menu untuk user tertentu
     * atau semua user jika tidak dispesifikkan
     *
     * @param  \App\Models\User|null  $user
     * @return void
     */
    function refreshMenuCache($user = null)
    {
        if ($user) {
            // Refresh cache user spesifik
            forgetCachedUserPermissions($user);
        } else {
            // Refresh semua cache menu
            forgetAllMenuCache();
        }
    }
}
