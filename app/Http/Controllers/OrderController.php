<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   public function setOrder(Request $request)
{
    $request->validate([
        'pickup_day' => 'required|string',
        'pickup_time' => 'required|string',
        'address' => 'required|string',
        'payment_type' => 'required|in:efectivo,tarjeta',
        'user_id' => 'required|exists:users,id', // temporal si no usas auth
    ]);

    $order = Order::create([
        'user_id' => $request->user_id,
        'pickup_day' => $request->pickup_day,
        'pickup_time' => $request->pickup_time,
        'address' => $request->address,
        'payment_type' => $request->payment_type,
    ]);

    return response()->json(['message' => 'Pedido registrado exitosamente', 'order' => $order], 201);
}

public function getHistory(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id'
    ]);

    $orders = Order::where('user_id', $request->user_id)
                   ->orderBy('created_at', 'desc')
                   ->get();

    return response()->json($orders);
}

}
