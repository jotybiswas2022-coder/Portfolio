<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a list of orders for the authenticated user.
     */
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.forex.my-orders', compact('orders'));
    }
    /**
     * Place an order — save to database and redirect to success page.
     */
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'items'   => 'required|json',
            'total'   => 'required|numeric|min:0',
            'name'    => 'nullable|string|max:100',
            'email'   => 'nullable|email|max:100',
            'notes'   => 'nullable|string|max:1000',
        ]);

        $items = json_decode($validated['items'], true);
        $user  = Auth::user();

        // Calculate subtotal from items to prevent manipulation
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += ($item['price'] ?? 0) * ($item['qty'] ?? 1);
        }

        $order = Order::create([
            'user_id'        => $user?->id,
            'order_number'   => Order::generateOrderNumber(),
            'items'          => $items,
            'subtotal'       => $subtotal,
            'total'          => $validated['total'],
            'status'         => 'pending',
            'customer_name'  => $validated['name'] ?? ($user?->name),
            'customer_email' => $validated['email'] ?? ($user?->email),
            'notes'          => $validated['notes'] ?? null,
        ]);

        return redirect()->route('order.success', ['order' => $order->order_number])
            ->with('success', 'Your order has been placed successfully! Order #' . $order->order_number);
    }

    /**
     * Order success page — show order details.
     */
    public function success(Request $request)
    {
        $orderNumber = $request->query('order');
        $order = null;

        if ($orderNumber) {
            $order = Order::where('order_number', $orderNumber)->first();
        }

        return view('frontend.forex.order-success', compact('order'));
    }
}
