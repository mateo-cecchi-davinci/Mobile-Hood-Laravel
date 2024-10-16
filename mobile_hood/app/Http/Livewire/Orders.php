<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class Orders extends Component
{
    public $pendingOrders;
    public $acceptedOrders;
    public $business;
    public $maps;
    public $listeners = ['orderReceived' => 'refreshPendingOrders'];
    public $unavailableProducts = [];
    public $products = [];
    public $newProducts = [];

    public function mount($business)
    {
        $this->business = $business;
        $this->maps = config('googlemaps.maps');
        $this->refreshPendingOrders();
        $this->refreshAcceptedOrders();
    }

    public function acceptOrder($order)
    {
        $order = $this->getOrder($order);

        $order->state = 'Aceptado';
        $order->save();

        $this->refreshPendingOrders();
        $this->refreshAcceptedOrders();
    }

    public function loadProducts()
    {
        $this->products = $this->business->categories->flatMap(function ($category) {
            return $category->products->where('is_active', true);
        })->all();
    }

    public function editAndAcceptOrder($order)
    {
        $newPayment = 0;
        $order = $this->getOrderWithProducts($order);

        foreach ($this->unavailableProducts as $productId) {
            $product = $this->getProduct($productId);
            $product->is_active = false;
            $product->save();
        }

        foreach ($this->newProducts as $productId) {
            $product = $this->getProduct($productId);
            $newPayment += $product->price;
            $newProductsWithAmount[$productId] = ['amount' => 1];
        }

        $order->products()->sync($newProductsWithAmount);

        $order->state = 'Aceptado';
        $order->payment = $newPayment;
        $order->save();

        $this->products = [];
        $this->unavailableProducts = [];
        $newProductsWithAmount = [];

        $this->refreshPendingOrders();
        $this->refreshAcceptedOrders();
    }

    public function readyOrder($order)
    {
        $order = $this->getOrder($order);

        $order->is_active = false;
        $order->state = 'Aceptado';
        $order->save();

        $this->refreshPendingOrders();
        $this->refreshAcceptedOrders();
    }

    public function rejectOrder($order)
    {
        $order = $this->getOrder($order);

        foreach ($this->unavailableProducts as $productId) {
            $product = $this->getProduct($productId);
            $product->is_active = false;
            $product->save();
        }

        $order->state = 'Rechazado';
        $order->save();

        $this->products = [];
        $this->unavailableProducts = [];

        $this->refreshPendingOrders();
        $this->refreshAcceptedOrders();
    }

    public function refreshPendingOrders()
    {
        $this->pendingOrders = $this->getPendingOrders($this->business->id);
    }

    public function refreshAcceptedOrders()
    {
        $this->acceptedOrders = $this->getAcceptedOrders($this->business->id);
    }

    private function getPendingOrders($business)
    {
        return Order::where(['is_active' => true, 'business_id' => $business, 'state' => 'Pendiente'])->with(['products', 'user'])->get();
    }

    private function getAcceptedOrders($business)
    {
        return Order::where(['is_active' => true, 'business_id' => $business, 'state' => 'Aceptado'])->with(['products', 'user'])->get();
    }

    private function getOrder($order)
    {
        return Order::find($order);
    }

    private function getOrderWithProducts($order)
    {
        return Order::with('products')->find($order);
    }

    private function getProduct($product)
    {
        return Product::find($product);
    }

    public function render()
    {
        return view('livewire.orders');
    }
}
