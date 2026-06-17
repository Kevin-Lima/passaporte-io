<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Tecnologia', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Música', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Negócios', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
