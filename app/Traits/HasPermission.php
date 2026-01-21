<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

trait HasPermission
{
    /**
     * Mapping method controller ke permission action
     * Ditambahkan: toggle, activate, deactivate untuk fitur aktivasi
     */
    protected $abilities = [
        'index'      => 'read',
        'create'     => 'create',
        'store'      => 'create',
        'show'       => 'read',
        'edit'       => 'update',
        'update'     => 'update',
        'destroy'    => 'delete',
        'toggle'     => 'activate',     // Toggle status aktif/nonaktif
        'activate'   => 'activate',     // Aktifkan
        'deactivate' => 'activate',     // Nonaktifkan (tetap pakai permission "activate")
        'status'     => 'activate',     // Ubah status
    ];

    /**
     * Intercept setiap pemanggilan method controller
     * untuk melakukan pengecekan permission secara otomatis
     */
    public function callAction($method, $parameters)
    {
        // Tentukan action yang sesuai (read, create, update, delete, activate)
        $action = Arr::get($this->abilities, $method);

        // Jika method tidak ada di mapping, skip permission check
        if (!$action) {
            return parent::callAction($method, $parameters);
        }

        // ===== 1. SKIP ROUTE PUBLIK =====
        if ($this->isPublicRoute()) {
            return parent::callAction($method, $parameters);
        }

        // ===== 2. CEK USER LOGIN =====
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->withErrors([
                'email' => 'Silakan login terlebih dahulu.'
            ]);
        }

        // ===== 3. CEK PERMISSION =====
        $this->checkPermission($user, $action);

        // ===== 4. LANJUTKAN KE METHOD CONTROLLER =====
        return parent::callAction($method, $parameters);
    }

    /**
     * Cek apakah route saat ini adalah public route
     *
     * @return bool
     */
    protected function isPublicRoute(): bool
    {
        $publicPaths = [
            'login',
            'logout',
            'register',
            'password/reset',
            'password/email',
            'password/confirm',
            'verification/verify',
            'verification/resend',
        ];

        $currentPath = trim(request()->path(), '/');

        foreach ($publicPaths as $path) {
            if (str_starts_with($currentPath, $path)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check permission user untuk action tertentu
     *
     * @param  \App\Models\User  $user
     * @param  string  $action  (read|create|update|delete|activate)
     * @return void
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    protected function checkPermission($user, string $action): void
    {
        // Ambil static path dari route (misal: "admin/users")
        $staticPath = $this->getStaticPath();

        // Ambil semua URL menu yang terdaftar
        $menuUrls = urlMenu();

        // Hanya cek permission jika path ada di menu
        if (!is_array($menuUrls) || !in_array($staticPath, $menuUrls)) {
            return;
        }

        // Format nama permission: "action path"
        // Contoh: "read admin/users", "activate admin/users"
        $permissionName = "{$action} {$staticPath}";

        // Ambil cached permissions user (lebih efisien daripada query DB)
        $permissions = cachedUserPermissions($user);
        $userDirectPermissions = $permissions['direct'] ?? [];
        $rolePermissions       = $permissions['role'] ?? [];

        // Cek apakah user punya permission (langsung atau via role)
        $hasDirectPermission = in_array($permissionName, $userDirectPermissions);
        $hasRolePermission   = in_array($permissionName, $rolePermissions);

        // Log aktivitas (development only - comment di production)
        if (config('app.debug')) {
            Log::info("Permission Check", [
                'user'       => $user->email,
                'permission' => $permissionName,
                'direct'     => $hasDirectPermission ? '✅' : '❌',
                'role'       => $hasRolePermission ? '✅' : '❌',
            ]);
        }

        // Jika tidak punya permission apapun, abort 403
        if (!$hasDirectPermission && !$hasRolePermission) {
            abort(403, "Akses ditolak: Anda tidak memiliki izin untuk {$permissionName}");
        }
    }

    /**
     * Ambil static path dari route
     * Bersihkan dari suffix create/edit/update/store/destroy/toggle
     *
     * @return string
     */
    protected function getStaticPath(): string
    {
        $staticPath = ltrim(request()->route()->getCompiled()->getStaticPrefix(), '/');

        // Hapus suffix action dari path
        $staticPath = preg_replace(
            '#/(create|edit|update|store|destroy|toggle|activate|deactivate|status)$#',
            '',
            $staticPath
        );

        return $staticPath;
    }

    /**
     * Helper untuk check permission secara manual (jika diperlukan)
     * Bisa dipanggil dari dalam method controller
     *
     * @param  string  $action
     * @return bool
     */
    protected function hasPermission(string $action): bool
    {
        $user = auth()->user();
        if (!$user) {
            return false;
        }

        $staticPath = $this->getStaticPath();
        $permissionName = "{$action} {$staticPath}";

        $permissions = cachedUserPermissions($user);
        $userDirectPermissions = $permissions['direct'] ?? [];
        $rolePermissions       = $permissions['role'] ?? [];

        return in_array($permissionName, $userDirectPermissions)
            || in_array($permissionName, $rolePermissions);
    }
}