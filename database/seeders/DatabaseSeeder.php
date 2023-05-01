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
        User::factory()->createOne(['name' => 'Usuário Admin', 'email' => 'admin@admin.com']);
        User::factory()->createOne(['name' => 'Usuário Agent', 'email' => 'agent@agent.com']);
        User::factory()->createOne(['name' => 'Usuário Normal', 'email' => 'user@auser.com']);

        $this->call(RoleSeeder::class);
        $this->call(TagSeeder::class);

        User::factory(10)->create()->each(fn ($user) => $user->assignRole('user'));
    }
}
