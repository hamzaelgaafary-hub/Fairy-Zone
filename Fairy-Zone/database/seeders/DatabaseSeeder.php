<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Master admin',
            'role' => 'master',
            'phone' => '1234567890',
            'email' => 'master@master.com',
            'password' => Hash::make('123456789'), // احرص على كتابة كلمة مرور قوية

        ]);
        User::factory()->create([
        'name' => 'Admin',
        'role' => 'admin',
        'phone' => '0987654321',
        'email' => 'admin@admin.com',
        'password' => Hash::make('123456789'), // احرص على كتابة كلمة مرور قوية
        ]);
        User::factory()->create([
        'name' => 'user',
        'role' => 'user',
        'phone' => '0987654322',
        'email' => 'user@user.com',
        'password' => Hash::make('123456789'), // احرص على كتابة كلمة مرور قوية
        ]);
    }
}
