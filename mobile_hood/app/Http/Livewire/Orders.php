<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public $pendingOrders;
    public $acceptedOrders;
    public $business;
    public $maps;
    public $listeners = ['orderReceived' => 'refreshOrders'];

    public function mount($business)
    {
        $this->business = $business;
        $this->maps = config('googlemaps.maps');
        $this->refreshOrders();
    }

    public function refreshOrders()
    {
        $this->pendingOrders = $this->getPendingOrders($this->business->id);
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

    public function render()
    {
        return view('livewire.orders');
    }
}
