<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
        $users = User::all();
        $products = Product::all();
        Order::factory()->count(5)->make()->each(function($order) use ($users, $products) {
            $order->user_id = $users->random()->id;
            $order->total_price = 0;
            $order->save();
            $selected = $products->random(2);
            $total = 0;
            foreach ($selected as $prod) {
                $quantity = rand(1,5);
                $order->products()->attach($prod->id, ['quantity'=>$quantity]);
                $total += $prod->price * $quantity;
            }
            $order->total_price = $total;
            $order->save();
        });
    }
}
