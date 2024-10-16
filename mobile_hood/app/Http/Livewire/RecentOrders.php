<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Order;
use Livewire\Component;

class RecentOrders extends Component
{
    public $business;
    public $timeFilter = 'Hoy';
    public $statusFilter = 'Todos';
    public $counter = 0;
    public $amount = 0;

    public function getRecentOrders($business)
    {
        $query = Order::where([
            'is_active' => true,
            'business_id' => $business
        ])->whereIn('state', ['Entregado', 'Rechazado'])->with('user');

        if ($this->timeFilter === 'Hoy') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($this->timeFilter === 'Ayer') {
            $query->whereDate('created_at', Carbon::yesterday());
        } elseif ($this->timeFilter === 'Últimos 7 días') {
            $query->whereDate('created_at', '>=', Carbon::now()->subDays(7));
        }

        if ($this->statusFilter !== 'Todos') {
            $query->where('state', $this->statusFilter);
        }

        $recentOrders = $query->get();

        $this->counter = $recentOrders->count();
        $this->amount = $recentOrders->sum('payment');

        return $recentOrders;
    }

    public function setTimeFilter($filter)
    {
        $this->timeFilter = $filter;
        $this->getRecentOrders($this->business->id);
    }

    public function setStatusFilter($filter)
    {
        $this->statusFilter = $filter;
        $this->getRecentOrders($this->business->id);
    }

    public function render()
    {
        $recentOrders = $this->getRecentOrders($this->business->id);

        return view('livewire.recent-orders', compact('recentOrders'));
    }
}
