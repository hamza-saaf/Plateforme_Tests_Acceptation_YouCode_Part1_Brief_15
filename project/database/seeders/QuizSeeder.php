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
                'description' => 'Answer the question quickly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Memory',
                'description' => 'Answer the question quickly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Matimatique',
                'description' => 'Answer the question quickly',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

