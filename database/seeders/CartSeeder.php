<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all()->toArray();
        for ($i = 0; $i < 5; $i++){
            $t = array_rand($users);
            Cart::create([
                'user_id' => $users[$t]['id'],
            ]);
        }
    }
}
