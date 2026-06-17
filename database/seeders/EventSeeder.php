<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'user_id' => 1,
                'category_id' => 1, // Tecnologia
                'title' => 'Laravel Summit 2026',
                'description' => 'A maior conferência de desenvolvimento Laravel da América Latina. Venha aprender sobre arquitetura, boas práticas e as novidades do Laravel 13 com especialistas do mercado.',
                'date_time' => '2026-12-01 09:00:00',
                'location' => 'Centro de Convenções, São Paulo - SP',
                'capacity' => 500,
                // Usando uma imagem real de tecnologia do Unsplash
                'banner_path' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'category_id' => 2, // Música
                'title' => 'Festival Jazz & Blues',
                'description' => 'Uma noite mágica ao som dos maiores nomes do Jazz e Blues. O evento contará com praça de alimentação gourmet e apresentações artísticas exclusivas ao ar livre.',
                'date_time' => '2026-11-15 19:30:00',
                'location' => 'Parque das Nações, Rio de Janeiro - RJ',
                'capacity' => 1200,
                // Usando uma imagem real de show/música do Unsplash
                'banner_path' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=800',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}