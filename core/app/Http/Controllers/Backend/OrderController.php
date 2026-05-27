<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Allowed order statuses.
     */
    const STATUSES = ['pending', 'processing', 'completed', 'cancelled'];

    /**
     * Display a listing of orders.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(20);
        return view('backend.order.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $statuses = self::STATUSES;
        return view('backend.order.show', compact('order', 'statuses'));
    }

    /**
     * Update the status of an order.
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string|in:' . implode(',', self::STATUSES),
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Order status updated to "' . ucfirst($validated['status']) . '".');
    }
}
