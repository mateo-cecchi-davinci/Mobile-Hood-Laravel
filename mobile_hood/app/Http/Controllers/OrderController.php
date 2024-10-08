<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Jobs\ProcessPayment;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Services\MercadoPagoService;

class OrderController extends Controller
{
    private $mercadoPagoService;
    protected $orders;
    protected $users;
    protected $maps;

    public function __construct(MercadoPagoService $mercadoPagoService)
    {
        //$this->middleware('auth');
        $this->orders = Order::where('is_active', true)->with('products')->get();
        $this->users = User::where('is_active', true)->get();
        $this->mercadoPagoService = $mercadoPagoService;
        $this->maps = config('googlemaps.maps');
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
            'business' => 'required|exists:businesses,id',
            'cartProducts' => 'required|array',
        ]);

        $user = $this->getUser(intval($request->user));

        $data = [
            'user' => $user,
            'product_data' => $request->cartProducts,
            'business' => intval($request->business)
        ];

        $preference = $this->mercadoPagoService->createPreference($data);

        return view('order', [
            'user' => $request->user,
            'business' => $request->business,
            'cartProducts' => $request->cartProducts,
            'preference' => $preference
        ]);
    }

    private function getUser($user)
    {
        return User::firstWhere(['is_active' => true, 'id' => $user]);
    }

    public function mp_payment_notification(Request $request)
    {
        ProcessPayment::dispatchSync($request->all());

        return response()->json(['status' => 'success'], 200);
    }

    public function userOrders(Request $request)
    {
        $request->validate([
            'orders' => 'array',
            'orders.*' => 'regex:/^[0-9]+$/'
        ]);

        $order = $this->getOrder(intval($request->orders[0]));
        $business = $this->getBusiness($order->business_id);

        return view('orders', [
            'order' => $order,
            'business' => $business,
            'maps' => $this->maps
        ]);
    }

    private function getOrder($order)
    {
        return Order::firstWhere(['id' => $order, 'state' => 'Pendiente', 'is_active' => true]);
    }

    private function getBusiness($business)
    {
        return Business::where(['id' => $business, 'is_active' => true])->with(['location'])->first();
    }
}
