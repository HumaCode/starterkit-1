<?php

namespace Database\Seeders;

use App\Models\Konfigurasi\Menu;
use App\Models\User;
use App\Traits\HasMenuPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class MenuSeeder extends Seeder
{
    use HasMenuPermission;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear all cache
        Cache::flush();

        // Get administrator user
        $administrator = User::where('email', 'administrator@gmail.com')->first();

        /**
         * ============================================
         * 📊 MENU: DASHBOARD
         * ============================================
         */
        $this->createMenu([
            'name'     => 'Dashboard',
            'url'      => 'dashboard',
            'category' => 'UTAMA',
            'icon'     => 'bi-grid-1x2',
            'active'   => 1,
            'orders'   => 1,
        ], ['read'], ['administrator', 'admin', 'user'], [$administrator]);


        // Sub-menu: Daftar Role
        $this->createMenu([
            'name'     => 'Daftar Menu',
            'url'      => 'menus',
            'category' => 'ROLE MANAGEMENT',
            'icon'     => 'bi-menu-button-wide',
            'active'   => 1,
            'orders'   => 2,
        ], ['create', 'read', 'update', 'delete', 'activate'], ['administrator'], [$administrator]);

        // Sub-menu: Kelompok
        $this->createMenu([
            'name'     => 'Role',
            'url'      => 'roles',
            'category' => 'ROLE MANAGEMENT',
            'icon'     => 'bi-collection',
            'active'   => 1,
            'orders'   => 3,
        ], ['create', 'read', 'update', 'delete', 'activate'], ['administrator'], [$administrator]);

        // Sub-menu: Permission
        $this->createMenu([
            'name'     => 'Permission',
            'url'      => 'permissions',
            'category' => 'ROLE MANAGEMENT',
            'icon'     => 'bi-shield-fill-check',
            'active'   => 1,
            'orders'   => 4,
        ], ['create', 'read', 'update', 'delete'], ['administrator'], [$administrator]);

        // Child-menu: Akses Role
        $this->createMenu([
            'name'     => 'Akses Role',
            'url'      => 'akses-role',
            'category' => 'ROLE MANAGEMENT',
            'icon'     => 'bi-shield-lock',
            'active'   => 1,
            'orders'   => 5,
        ], ['create', 'read', 'update', 'delete', 'activate'], ['administrator'], [$administrator]);

        // Child-menu: User
        $this->createMenu([
            'name'     => 'User',
            'url'      => 'users',
            'category' => 'ROLE MANAGEMENT',
            'icon'     => 'bi-people',
            'active'   => 1,
            'orders'   => 6,
        ], ['create', 'read', 'update', 'delete', 'activate'], ['administrator'], [$administrator]);

        $this->command->info('✅ Menu seeding completed!');
    }

    /**
     * Helper method untuk create menu dengan permissions
     *
     * @param  array  $menuData
     * @param  array  $permissions
     * @param  array  $roles
     * @param  array  $users
     * @return \App\Models\Menu
     */
    private function createMenu(array $menuData, array $permissions, array $roles = [], array $users = []): Menu
    {
        $menu = Menu::create($menuData);

        // Attach permissions
        $this->attachMenuPermission($menu, $permissions, $roles, $users);

        return $menu;
    }
}
