<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 20; $i++){
            $title = fake()->unique()->name;
            $slug = Str::slug($title);
            $parent_id = $i > 1 ? $i-1 : null;
            $this->command->info("{$i}   {$parent_id}");
            Category::create(
                [
                    'id' => $i,
                    'parent_category_id' => $parent_id,
                    'title' => $title,
                    'slug' => $slug,
                    'description' => fake()->realText(),
                ]
            );
        }
    }
}
