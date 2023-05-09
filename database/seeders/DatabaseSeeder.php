<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(DepartmentSeeder::class);

        $password = bcrypt('12345678');

        // Administrador
        User::factory()->createOne(['name' => 'Usuário Administrador', 'email' => 'admin@email.com', 'password' => $password, 'avatar' => 'avatars/woman_1.jpg']);

        // Funcionários de departamento
        User::factory()->createOne(['name' => 'Usuário Funcionário', 'email' => 'funcionario@email.com', 'password' => $password, 'avatar' => 'avatars/men_1.jpg']);
        User::factory()->createOne(['name' => 'Usuário Funcionário 01', 'email' => 'funcionario01@email.com', 'password' => $password, 'avatar' => 'avatars/men_2.jpg']);
        User::factory()->createOne(['name' => 'Usuário Funcionário 02', 'email' => 'funcionario02@email.com', 'password' => $password, 'avatar' => 'avatars/woman_2.jpg']);
        User::factory()->createOne(['name' => 'Usuário Funcionário 03', 'email' => 'funcionario03@email.com', 'password' => $password, 'avatar' => 'avatars/woman_3.jpg']);

        // Clientes
        User::factory()->createOne(['name' => 'Usuário Cliente', 'email' => 'cliente@email.com', 'password' => $password, 'avatar' => 'avatars/men_3.jpg']);
        User::factory()->createOne(['name' => 'Usuário Cliente 01', 'email' => 'cliente01@email.com', 'password' => $password, 'avatar' => 'avatars/men_4.jpg']);
        User::factory()->createOne(['name' => 'Usuário Cliente 02', 'email' => 'cliente02@email.com', 'password' => $password, 'avatar' => 'avatars/woman_4.jpg']);
        User::factory()->createOne(['name' => 'Usuário Cliente 03', 'email' => 'cliente03@email.com', 'password' => $password, 'avatar' => 'avatars/woman_5.jpg']);

        User::find(1)->assignRole('admin');
        User::whereIn('id', [2,3,4,5])->each(fn($user) => $user->assignRole('agent'));
        User::whereIn('id', [6,7,8,9])->each(fn($user) => $user->assignRole('user'));
    }
}
