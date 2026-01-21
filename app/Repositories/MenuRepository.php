<?php

namespace App\Repositories;

use App\Models\Konfigurasi\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

use function App\Helpers\cachedUserPermissions;
use function App\Helpers\refreshMenuCache;
use function App\Helpers\userHasMenuPermission;

class MenuRepository
{
    /**
     * Ambil semua menu aktif dengan permissions
     * Untuk management/settings page
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMenusWithPermissions(): Collection
    {
        return Menu::with('permissions')
            ->where('active', 1)
            ->orderBy('orders')
            ->get();
    }

    /**
     * Ambil semua menu aktif (tanpa permission check)
     * Untuk build cache menu global
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMenus(): Collection
    {
        return Menu::active()
            ->orderBy('orders')
            ->get();
    }

    /**
     * Ambil semua menu (termasuk yang nonaktif)
     * Untuk halaman admin/management menu
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllMenus(): Collection
    {
        return Menu::with('permissions')
            ->orderBy('orders')
            ->get();
    }

    /**
     * Ambil menu berdasarkan kategori
     *
     * @param  string|null  $category
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMenusByCategory(?string $category = null): Collection
    {
        $query = Menu::active()->orderBy('orders');

        if ($category) {
            $query->where('category', $category);
        }

        return $query->get();
    }

    /**
     * Ambil menu yang diizinkan untuk user tertentu
     * Dengan permission check
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMenusForUser(User $user): Collection
    {
        $menus = $this->getMenus();
        $permissions = cachedUserPermissions($user);

        return $menus->filter(function ($menu) use ($user, $permissions) {
            return userHasMenuPermission($menu, $user, $permissions);
        })->values();
    }

    /**
     * Ambil menu berdasarkan URL
     *
     * @param  string  $url
     * @return \App\Models\Menu|null
     */
    public function findByUrl(string $url): ?Menu
    {
        return Menu::where('url', $url)->first();
    }

    /**
     * Ambil semua kategori menu yang ada
     *
     * @return array
     */
    public function getCategories(): array
    {
        return Menu::active()
            ->distinct('category')
            ->pluck('category')
            ->filter()
            ->values()
            ->toArray();
    }

    /**
     * Create menu baru dengan permissions
     *
     * @param  array  $data
     * @param  array|null  $permissions
     * @param  array|null  $roles
     * @return \App\Models\Menu
     */
    public function createWithPermissions(array $data, ?array $permissions = null, ?array $roles = null): Menu
    {
        $menu = Menu::create($data);

        // Attach permissions otomatis
        $menu->attachMenuPermission($menu, $permissions, $roles);

        // Clear cache
        refreshMenuCache();

        return $menu;
    }

    /**
     * Update menu dan sync permissions
     *
     * @param  \App\Models\Menu  $menu
     * @param  array  $data
     * @param  array|null  $permissions
     * @param  array|null  $roles
     * @return \App\Models\Menu
     */
    public function updateWithPermissions(Menu $menu, array $data, ?array $permissions = null, ?array $roles = null): Menu
    {
        $menu->update($data);

        // Sync permissions (hapus lama, buat baru)
        if ($permissions !== null || $roles !== null) {
            $menu->syncMenuPermission($menu, $permissions, $roles);
        }

        // Clear cache
        refreshMenuCache();

        return $menu;
    }

    /**
     * Delete menu dan hapus permissions terkait
     *
     * @param  \App\Models\Menu  $menu
     * @return bool
     */
    public function deleteWithPermissions(Menu $menu): bool
    {
        // Detach permissions
        $menu->detachMenuPermission($menu);

        // Delete menu
        $deleted = $menu->delete();

        // Clear cache
        if ($deleted) {
            refreshMenuCache();
        }

        return $deleted;
    }

    /**
     * Toggle status aktif menu
     *
     * @param  \App\Models\Menu  $menu
     * @return \App\Models\Menu
     */
    public function toggleActive(Menu $menu): Menu
    {
        $menu->update([
            'active' => !$menu->active
        ]);

        // Clear cache
        refreshMenuCache();

        return $menu;
    }

    /**
     * Reorder menu (update urutan)
     *
     * @param  array  $orders  [['id' => 1, 'order' => 1], ['id' => 2, 'order' => 2]]
     * @return bool
     */
    public function reorder(array $orders): bool
    {
        foreach ($orders as $item) {
            Menu::where('id', $item['id'])
                ->update(['orders' => $item['order']]);
        }

        // Clear cache
        refreshMenuCache();

        return true;
    }

    /**
     * Get menu statistics
     *
     * @return array
     */
    public function getStatistics(): array
    {
        return [
            'total' => Menu::count(),
            'active' => Menu::where('active', 1)->count(),
            'inactive' => Menu::where('active', 0)->count(),
            'by_category' => Menu::active()
                ->selectRaw('category, COUNT(*) as count')
                ->groupBy('category')
                ->pluck('count', 'category')
                ->toArray(),
        ];
    }
}