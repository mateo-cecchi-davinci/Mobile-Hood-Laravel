<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orders;
    protected $users;

    public function __construct()
    {
        $this->middleware('auth');
        $this->orders = Order::where('is_active', true)->with('products')->get();
        $this->users = User::where('is_active', true)->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('orders.orders', [
            'orders' => $this->orders
        ]);
    }

    public function create()
    {
        return view('orders.create', [
            'users' => $this->users
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment' => 'required|numeric',
            'state' => 'required|string|max:255',
            'user' => 'required|array|min:1|max:1',
        ]);

        $order = new Order();

        $order->payment = $request->payment;
        $order->state = $request->state;
        $order->fk_orders_users = $request->user[0];
        $current_date_time = Carbon::now()->toDateTimeString();
        $order->created_at = $current_date_time;

        $order->save();

        return redirect(route('orders.index'))->with('success', __('messages.add_order_message'));
    }

    public function show(Order $order)
    {
        return view('orders.show', [
            'order' => $order
        ]);
    }

    public function edit(Order $order)
    {
        return view('orders.edit', [
            'users' => $this->users,
            'order' => $order
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'payment' => 'required|numeric',
            'state' => 'required|string|max:255',
            'user' => 'required|array|min:1|max:1',
        ]);

        $order->payment = $request->payment;
        $order->state = $request->state;
        $order->fk_orders_users = $request->user[0];
        $current_date_time = Carbon::now()->toDateTimeString();
        $order->updated_at = $current_date_time;

        $order->save();

        return redirect(route('orders.index'))->with('success', __('messages.update_order_message'));
    }

    public function destroy(Order $order)
    {
        $order->update([
            'is_active' => false,
        ]);

        return redirect(route('products.index'))->with('success', __('messages.delete_order_message'));
    }

    public function order(Request $request)
    {
        $request->merge([
            'cartProducts' => json_decode($request->input('cartProducts'), true)
        ]);

        $request->validate([
            'user' => 'required|exists:users,id',
            'buisness' => 'required|exists:buisnesses,id',
            'cartProducts' => 'required|array',
        ]);

        return view('order', [
            'user' => $request->user,
            'buisness' => $request->buisness,
            'cartProducts' => $request->cartProducts,
        ]);
    }
}
