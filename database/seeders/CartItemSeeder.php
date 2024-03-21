<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $carts = Cart::all();
        foreach ($carts as $cart){
            for($i = 0; $i < 5; $i++){
                $product = $products->random();
                if(!in_array($product->id, $cart->cartItems()->pluck('product_id')->toArray())){
                    $cartItem = CartItem::create([
                        'cart_id' => $cart->id,
                        'product_id' => $product->id,
                    ]);
                }else{
                    $this->command->info('yeahh');
                    $cart->cartItems()->where('product_id', $product->id)->increment('quantity');
                }
            }
        }

    }
}
