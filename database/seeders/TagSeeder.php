<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create(['name' => 'Bug']);
        Tag::create(['name' => 'Pergunta']);
        Tag::create(['name' => 'Sugestão']);
        Tag::create(['name' => 'Instatisfação']);
    }
}
