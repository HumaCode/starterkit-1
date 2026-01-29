<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default attributes untuk semua user
        $defaultAttributes = [
            'email_verified_at' => now(),
            'password'          => Hash::make('123'),
            'remember_token'    => Str::random(20),
            'is_active'         => '1',
            'registration_type' => 'manual',
        ];

        /**
         * ============================================
         * 👥 CREATE DEFAULT USERS (Main Roles)
         * ============================================
         */
        $defaultUsers = [
            [
                'role'       => 'administrator',
                'first_name' => 'Super',
                'last_name'  => 'Admin',
                'username'   => 'administrator',
                'email'      => 'administrator@gmail.com',
                'phone'      => '081234567890',
                'gender'     => 'male',
            ],
            [
                'role'       => 'admin',
                'first_name' => 'Admin',
                'last_name'  => 'User',
                'username'   => 'admin',
                'email'      => 'admin@gmail.com',
                'phone'      => '081234567891',
                'gender'     => 'male',
            ],
            [
                'role'       => 'user',
                'first_name' => 'Regular',
                'last_name'  => 'User',
                'username'   => 'user',
                'email'      => 'user@gmail.com',
                'phone'      => '081234567892',
                'gender'     => 'female',
            ],
        ];

        foreach ($defaultUsers as $userData) {
            $role = $userData['role'];
            unset($userData['role']);

            $user = User::create([...$defaultAttributes, ...$userData]);
            $user->assignRole($role);

            $this->command->info("✅ Created user: {$user->email} with role: {$role}");
        }

        /**
         * ============================================
         * 👥 CREATE ADDITIONAL TEST USERS (Optional)
         * ============================================
         */
        // Uncomment jika ingin tambah user manual lainnya
        /*
        $additionalUsers = [
            [
                'role'       => 'admin',
                'first_name' => 'Admin',
                'last_name'  => 'Kedua',
                'username'   => 'admin2',
                'email'      => 'admin2@gmail.com',
                'phone'      => '081234567893',
                'gender'     => 'male',
            ],
            [
                'role'       => 'user',
                'first_name' => 'John',
                'last_name'  => 'Doe',
                'username'   => 'johndoe',
                'email'      => 'john@example.com',
                'phone'      => '081234567894',
                'gender'     => 'male',
            ],
        ];

        foreach ($additionalUsers as $userData) {
            $role = $userData['role'];
            unset($userData['role']);

            $user = User::create([...$defaultAttributes, ...$userData]);
            $user->assignRole($role);

            $this->command->info("✅ Created user: {$user->email} with role: {$role}");
        }
        */

        /**
         * ============================================
         * 🎲 GENERATE RANDOM USERS (Factory)
         * ============================================
         */
        $this->command->info('🎲 Generating 60 random users...');

        $roles = ['administrator', 'admin', 'user'];

        User::factory(60)->create()->each(function ($user) use ($roles) {
            // Assign random role
            $randomRole = $roles[array_rand($roles)];
            $user->assignRole($randomRole);

            // Update registration_type to manual
            $user->update(['registration_type' => 'manual']);
        });

        $this->command->info('✅ User seeding completed!');

        /**
         * ============================================
         * 📊 SUMMARY
         * ============================================
         */
        $this->displaySummary();
    }

    /**
     * Display seeding summary
     */
    private function displaySummary(): void
    {
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $administrators = User::role('administrator')->count();
        $admins = User::role('admin')->count();
        $users = User::role('user')->count();

        $this->command->newLine();
        $this->command->info('📊 SEEDING SUMMARY:');
        $this->command->table(
            ['Metric', 'Count'],
            [
                ['Total Users', $totalUsers],
                ['Active Users', $activeUsers],
                ['Administrators', $administrators],
                ['Admins', $admins],
                ['Regular Users', $users],
            ]
        );
    }
}
