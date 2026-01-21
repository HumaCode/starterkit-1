<?php

namespace App\Traits;

use App\Models\Konfigurasi\Menu;
use App\Models\Shield\Permission;

trait HasMenuPermission
{
    /**
     * Attach permissions (CRUD + Activate) ke Menu
     *
     * @param  \App\Models\Menu  $menu
     * @param  array|null  $permissions  ['create', 'read', 'update', 'delete', 'activate']
     * @param  array|null  $roles  ['admin', 'user']
     * @param  array|null  $users  [User $user1, User $user2]
     * @return void
     */
    public function attachMenuPermission(Menu $menu, array|null $permissions = null, array|null $roles = null, array|null $users = null)
    {
        // Default permissions: CRUD + Activate
        if (empty($permissions)) {
            $permissions = ['create', 'read', 'update', 'delete', 'activate'];
        }

        foreach ($permissions as $item) {
            // Permission name unik berdasarkan action + URL menu
            // Contoh: "read konfigurasi/menu", "activate konfigurasi/menu"
            $permissionName = $item . ' ' . $menu->url;

            // Buat permission atau ambil yang sudah ada
            $permission = Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'web'
            ]);

            // Attach permission ke menu (many-to-many relationship)
            $permission->menus()->syncWithoutDetaching([$menu->id]);

            // Assign permission ke roles jika ada
            if (!empty($roles)) {
                $permission->syncRoles($roles);
            }

            // Assign permission langsung ke user spesifik jika ada
            if (!empty($users)) {
                foreach ($users as $user) {
                    if ($user) {
                        $user->givePermissionTo($permission);
                    }
                }
            }
        }
    }

    /**
     * Detach semua permissions dari Menu
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */
    public function detachMenuPermission(Menu $menu)
    {
        // Ambil semua permission yang terkait dengan menu ini
        $permissions = Permission::where('name', 'like', '% ' . $menu->url)->get();

        foreach ($permissions as $permission) {
            // Hapus relasi dengan menu
            $permission->menus()->detach($menu->id);

            // Jika permission tidak digunakan menu lain, hapus permission
            if ($permission->menus()->count() === 0) {
                $permission->delete();
            }
        }
    }

    /**
     * Sync permissions Menu (hapus yang lama, buat yang baru)
     *
     * @param  \App\Models\Menu  $menu
     * @param  array|null  $permissions
     * @param  array|null  $roles
     * @param  array|null  $users
     * @return void
     */
    public function syncMenuPermission(Menu $menu, array|null $permissions = null, array|null $roles = null, array|null $users = null)
    {
        // Hapus permission lama
        $this->detachMenuPermission($menu);

        // Buat permission baru
        $this->attachMenuPermission($menu, $permissions, $roles, $users);
    }
}