<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 10; $i++){
            Review::firstOrCreate([
                'user_id' => 1,
                'product_id' => 1,
                'comment' => fake()->text,
                'rating' => fake()->numberBetween(1,5),
            ]);
        }
    }
}
