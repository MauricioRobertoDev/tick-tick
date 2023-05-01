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
        $password = bcrypt('12345678');
        User::factory()->createOne(['name' => 'Usuário Administrador', 'email' => 'admin@email.com', 'password' => $password]);
        User::factory()->createOne(['name' => 'Usuário Funcionário', 'email' => 'funcionario@email.com', 'password' => $password]);
        User::factory()->createOne(['name' => 'Usuário Cliente', 'email' => 'cliente@email.com', 'password' => $password]);

        $this->call(RoleSeeder::class);
        $this->call(TagSeeder::class);

        User::factory(10)->create()->each(fn ($user) => $user->assignRole('user'));
    }
}
