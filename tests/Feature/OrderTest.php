<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_order_creation_and_retrieval() {
        $user = User::factory()->create();
        $products = Product::factory()->count(2)->create();
        $payload = [
            'user_id'=>$user->id,
            'products'=>[
                ['id'=>$products[0]->id,'quantity'=>2],
                ['id'=>$products[1]->id,'quantity'=>1],
            ],
        ];
        $res = $this->postJson('/api/orders', $payload);
        $res->assertStatus(201)
            ->assertJsonFragment(['user_id'=>$user->id])
            ->assertJsonCount(2, 'products');
        $orderId = $res->json('id');

        $this->getJson("/api/orders/{$orderId}")
            ->assertStatus(200)
            ->assertJsonFragment(['id'=>$orderId]);
    }

    public function test_prevent_double_posting_duplicate() {
        // simulate same payload twice
        $user = User::factory()->create();
        $prod = Product::factory()->create();
        $payload = ['user_id'=>$user->id, 'products'=>[['id'=>$prod->id,'quantity'=>1]]];
        $r1 = $this->postJson('/api/orders', $payload);
        $r2 = $this->postJson('/api/orders', $payload);
        $r2->assertStatus(429);
    }
}
