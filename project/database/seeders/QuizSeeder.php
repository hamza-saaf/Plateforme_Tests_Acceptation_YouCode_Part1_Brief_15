<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    public function run()
    {
        DB::table('quizzes')->insert([
            [
                'title' => 'Logique',
                'description' => 'answer the quietions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Memory',
                'description' => 'answer the quietions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Matimatique',
                'description' => 'answer the quietions',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

