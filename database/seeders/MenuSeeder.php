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
            'icon'     => 'ri-dashboard-fill',
            'active'   => 1,
            'orders'   => 1,
        ], ['read'], ['administrator', 'admin', 'user'], [$administrator]);

        /**
         * ============================================
         * 📁 MENU: MANAJEMEN PROJECT
         * ============================================
         */
        // Menu Project (Parent/Category)
        $this->createMenu([
            'name'     => 'Manajemen Project',
            'url'      => 'project',
            'category' => 'MANAJEMEN PROYEK',
            'icon'     => 'ri-folder-fill',
            'active'   => 1,
            'orders'   => 2,
        ], ['read'], ['administrator'], [$administrator]);

        // Sub-menu: Daftar Project
        $this->createMenu([
            'name'     => 'Daftar Project',
            'url'      => 'project/list',
            'category' => 'MANAJEMEN PROYEK',
            'icon'     => 'ri-file-list-fill',
            'active'   => 1,
            'orders'   => 3,
        ], ['create', 'read', 'update', 'delete', 'activate'], ['administrator'], [$administrator]);

        // Sub-menu: Kelompok
        $this->createMenu([
            'name'     => 'Kelompok',
            'url'      => 'project/kelompok',
            'category' => 'MANAJEMEN PROYEK',
            'icon'     => 'ri-group-fill',
            'active'   => 1,
            'orders'   => 4,
        ], ['create', 'read', 'update', 'delete', 'activate'], ['administrator'], [$administrator]);

        // Sub-menu: Dokumen
        $this->createMenu([
            'name'     => 'Dokumen',
            'url'      => 'project/dokumen',
            'category' => 'MANAJEMEN PROYEK',
            'icon'     => 'ri-folder-2-fill',
            'active'   => 1,
            'orders'   => 5,
        ], ['create', 'read', 'update', 'delete'], ['administrator'], [$administrator]);

        // Child-menu: Dokumen File
        $this->createMenu([
            'name'     => 'Dokumen File',
            'url'      => 'project/dokumen/file',
            'category' => 'MANAJEMEN PROYEK',
            'icon'     => 'ri-file-3-fill',
            'active'   => 1,
            'orders'   => 6,
        ], ['create', 'read', 'update', 'delete', 'activate'], ['administrator'], [$administrator]);

        // Child-menu: Dokumen Arsip
        $this->createMenu([
            'name'     => 'Dokumen Arsip',
            'url'      => 'project/dokumen/arsip',
            'category' => 'MANAJEMEN PROYEK',
            'icon'     => 'ri-archive-fill',
            'active'   => 1,
            'orders'   => 7,
        ], ['create', 'read', 'update', 'delete'], ['administrator'], [$administrator]);

        // Sub-menu: Meeting
        $this->createMenu([
            'name'     => 'Meeting',
            'url'      => 'project/meeting',
            'category' => 'MANAJEMEN PROYEK',
            'icon'     => 'ri-calendar-event-fill',
            'active'   => 1,
            'orders'   => 8,
        ], ['create', 'read', 'update', 'delete'], ['administrator'], [$administrator]);

        // Child-menu: Meeting Attendance
        $this->createMenu([
            'name'     => 'Absensi Meeting',
            'url'      => 'project/meeting/attendance',
            'category' => 'MANAJEMEN PROYEK',
            'icon'     => 'ri-checkbox-circle-fill',
            'active'   => 1,
            'orders'   => 9,
        ], ['create', 'read', 'update'], ['administrator'], [$administrator]);

        // Child-menu: Meeting Notes
        $this->createMenu([
            'name'     => 'Catatan Meeting',
            'url'      => 'project/meeting/notes',
            'category' => 'MANAJEMEN PROYEK',
            'icon'     => 'ri-file-text-fill',
            'active'   => 1,
            'orders'   => 10,
        ], ['create', 'read', 'update', 'delete'], ['administrator'], [$administrator]);

        /**
         * ============================================
         * 👥 MENU: MANAJEMEN USER
         * ============================================
         */
        $this->createMenu([
            'name'     => 'Manajemen User',
            'url'      => 'admin/users',
            'category' => 'ADMINISTRASI',
            'icon'     => 'ri-user-settings-fill',
            'active'   => 1,
            'orders'   => 11,
        ], ['create', 'read', 'update', 'delete', 'activate'], ['administrator'], [$administrator]);

        /**
         * ============================================
         * 🔐 MENU: ROLE & PERMISSION
         * ============================================
         */
        $this->createMenu([
            'name'     => 'Role & Permission',
            'url'      => 'admin/roles',
            'category' => 'ADMINISTRASI',
            'icon'     => 'ri-shield-user-fill',
            'active'   => 1,
            'orders'   => 12,
        ], ['create', 'read', 'update', 'delete'], ['administrator'], [$administrator]);

        /**
         * ============================================
         * ⚙️ MENU: KONFIGURASI
         * ============================================
         */
        $this->createMenu([
            'name'     => 'Konfigurasi',
            'url'      => 'konfigurasi',
            'category' => 'PENGATURAN',
            'icon'     => 'ri-settings-3-fill',
            'active'   => 1,
            'orders'   => 13,
        ], ['read'], ['administrator'], [$administrator]);

        // Sub-menu: Menu Management
        $this->createMenu([
            'name'     => 'Manajemen Menu',
            'url'      => 'konfigurasi/menu',
            'category' => 'PENGATURAN',
            'icon'     => 'ri-menu-fill',
            'active'   => 1,
            'orders'   => 14,
        ], ['create', 'read', 'update', 'delete', 'activate'], ['administrator'], [$administrator]);

        // Sub-menu: System Settings
        $this->createMenu([
            'name'     => 'Pengaturan Sistem',
            'url'      => 'konfigurasi/settings',
            'category' => 'PENGATURAN',
            'icon'     => 'ri-tools-fill',
            'active'   => 1,
            'orders'   => 15,
        ], ['read', 'update'], ['administrator'], [$administrator]);

        /**
         * ============================================
         * 📝 MENU: LAPORAN
         * ============================================
         */
        $this->createMenu([
            'name'     => 'Laporan',
            'url'      => 'reports',
            'category' => 'LAPORAN',
            'icon'     => 'ri-file-chart-fill',
            'active'   => 1,
            'orders'   => 16,
        ], ['read'], ['administrator', 'admin'], [$administrator]);

        $this->createMenu([
            'name'     => 'Laporan Project',
            'url'      => 'reports/project',
            'category' => 'LAPORAN',
            'icon'     => 'ri-file-list-3-fill',
            'active'   => 1,
            'orders'   => 17,
        ], ['read'], ['administrator', 'admin'], [$administrator]);

        $this->createMenu([
            'name'     => 'Laporan Aktivitas',
            'url'      => 'reports/activity',
            'category' => 'LAPORAN',
            'icon'     => 'ri-line-chart-fill',
            'active'   => 1,
            'orders'   => 18,
        ], ['read'], ['administrator', 'admin'], [$administrator]);

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
