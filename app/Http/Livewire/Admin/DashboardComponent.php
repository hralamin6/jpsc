<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sell;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class DashboardComponent extends Component
{
    public $startDate, $endDate;
    public function render()
    {
//        dd(Carbon::parse($this->startDate));
        $sells = Sell::when($this->startDate, function($query) {
            return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
        })->when($this->endDate, function($query) {
            return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
        })->whereStatus('active')->get();

        $purchases = Purchase::when($this->startDate, function($query) {
            return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
        })->when($this->endDate, function($query) {
            return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
        })->whereStatus('active')->get();

        $customers = User::when($this->startDate, function($query) {
            return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
        })->when($this->endDate, function($query) {
            return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
        })->whereType('customer')->get();

        $sellers = User::when($this->startDate, function($query) {
            return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
        })->when($this->endDate, function($query) {
            return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
        })->whereType('seller')->get();

        $products = Product::when($this->startDate, function($query) {
            return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
        })->when($this->endDate, function($query) {
            return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
        })->get();

        return view('livewire.admin.dashboard-component',
            compact('customers', 'sellers', 'sells', 'purchases', 'products'));
    }
}
