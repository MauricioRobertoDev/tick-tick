<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'agent']);
        Role::create(['name' => 'user']);

        User::factory()->createOne(['name' => 'Usuário Admin', 'email' => 'admin@admin.com'])->assignRole('admin');
        User::factory()->create(['name' => 'Usuário Agent', 'email' => 'agent@agent.com'])->assignRole('agent');
        User::factory()->create(['name' => 'Usuário Normal', 'email' => 'user@auser.com'])->assignRole('user');
    }
}
