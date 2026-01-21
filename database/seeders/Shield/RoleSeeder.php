<?php

namespace Database\Seeders\Shield;

use App\Models\Shield\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of roles to be created
        $roles = [
            [
                'name' => 'administrator',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user',
                'guard_name' => 'web',
            ],
        ];

        // Create roles
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
