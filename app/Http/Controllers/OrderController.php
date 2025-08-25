<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        return Order::with('user','products')->get();
    }
    public function show($id) {
        return Order::with('user','products')->findOrFail($id);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'user_id'=>'required|exists:users,id',
            'products'=>'required|array|min:1',
            'products.*.id'=>'required|exists:products,id',
            'products.*.quantity'=>'required|integer|min:1'
        ]);
        $key = 'order_create_'.$request->ip();
        if (cache()->add($key, true, 10)) {
            $order = Order::create(['user_id'=>$data['user_id'], 'status'=>'new','total_price'=>0]);
            $total = 0;
            foreach ($data['products'] as $p) {
                $order->products()->attach($p['id'], ['quantity'=>$p['quantity']]);
                $prod = \App\Models\Product::find($p['id']);
                $total += $prod->price * $p['quantity'];
            }
            $order->total_price = $total;
            $order->save();
            return response()->json($order->load('user','products'), 201);
        }
        return response()->json(['message'=>'Duplicate attempt'], 429);
    }
    public function updateStatus(Request $request, $id) {
        $order = Order::findOrFail($id);
        $status = $request->validate(['status'=>'required|in:new,processed,completed'])['status'];
        $order->update(['status'=>$status]);
        return response()->json($order);
    }


    public function destroy($id) {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(null, 204);
    }
}
