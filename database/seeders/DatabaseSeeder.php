<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Executa o seeder de categorias
        $this->call(CategorySeeder::class);

        //Cria o Usuário Organizador Padrão (Admin/Staff)
        DB::table('users')->insert([
            'name' => 'Professor Organizador',
            'email' => 'organizador@teste.com',
            'password' => Hash::make('senha123'), //Criptografia
            'role' => 'organizer',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //Cria o Usuário Participante Padrãophp artisan migrate:fresh --seed (User/Client)
        DB::table('users')->insert([
            'name' => 'Aluno Participante',
            'email' => 'participante@teste.com',
            'password' => Hash::make('senha123'), 
            'role' => 'participant',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call(EventSeeder::class);
    }
}
