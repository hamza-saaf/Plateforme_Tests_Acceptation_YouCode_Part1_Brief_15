<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     DB::table('questions')->insert([
        [
            'question' => '4(5+6)/2',
            'image' => null,
            'is_multiple_choice' => false,
            'quiz_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        
        ],
        [
            'question' => '60*4',
            'image' => null,
            'is_multiple_choice' => false,
            'quiz_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        
        ],
        [
            'question' => '100/100*100',
            'image' => null,
            'is_multiple_choice' => false,
            'quiz_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        
        ]
     ]);
    }
}
