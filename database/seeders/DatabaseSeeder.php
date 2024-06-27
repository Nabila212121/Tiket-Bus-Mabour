<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Superadmin',
            'email' => 'superadmin@mabour.id',
            'password' => bcrypt('password'),
        ]);
        $role = \Spatie\Permission\Models\Role::create(['name' => 'superadmin']);
        $user->assignRole($role);
        \Spatie\Permission\Models\Role::create(['name' => 'admin']);
        \Spatie\Permission\Models\Role::create(['name' => 'user']);
    }
}
