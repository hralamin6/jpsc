<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\PaidAmount;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sell;
use App\Models\Setup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class SellComponent extends Component
{
    public $startDate, $endDate;
    use WithPagination;
    use LivewireAlert;

    public $state = [], $sell, $editmode, $name, $orderBy='id', $serialize='desc', $paginate=10, $search='', $sellId, $selectall = false, $selections = [];
    protected $listeners = ['deleteConfirmed' => 'delete', 'sell_confirmed' => 'sell_confirmed'];

    protected $paginationTheme = 'bootstrap';
    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form', ['action'=>'show']);
    }
    public function create_sell()
    {
        $validatedData = Validator::make($this->state, [
            'product_id' => ['required'],
            'category_id' => ['required'],
            'user_id' => ['required'],
            'quantity' => ['required', 'numeric'],
            'kg' => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
        ])->validate();
        $validatedData['total_price'] = $validatedData['kg']*$validatedData['unit_price'];
        $validatedData['due_price'] = $validatedData['total_price'];
        $validatedData['paid_price'] = 0;
            Sell::create($validatedData);
            $this->dispatchBrowserEvent('show-form', ['action'=>'hide']);
            $this->alert('success', 'Successfully inserted');
    }
    public function Edit(Sell $sell)
    {
        $this->reset();
        $this->editmode = true;
        $this->sell = $sell;
        $this->state = $sell->toArray();
        $this->dispatchBrowserEvent('show-form', ['action'=>'show']);
    }

    public function update_sell()
    {
        $validatedData = Validator::make($this->state, [
            'product_id' => ['required'],
            'category_id' => ['required'],
            'user_id' => ['required'],
            'quantity' => ['required', 'numeric'],
            'kg' => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
        ])->validate();
        $validatedData['total_price'] = $validatedData['kg']*$validatedData['unit_price'];
        $validatedData['due_price'] = $validatedData['total_price'];
        $validatedData['paid_price'] = 0;
        $this->sell->update($validatedData);
            $this->dispatchBrowserEvent('show-form', ['action' => 'hide']);
            $this->alert('success', 'Successfully updated');
    }
    public function confirm_sell($id)
    {
        $this->sellId = $id;
        $this->dispatchBrowserEvent('show-sell-confirmation');
    }


    public function sell_confirmed()
    {
        $sell = Sell::find($this->sellId);
        $product = $sell->product;
        $customer = $sell->customer;
        if ($product->stock_kg<$sell->kg | $product->stock_quantity<$sell->quantity) {
            $this->alert('error', 'You does not have enough stock');
        }else{
            if ($sell->status==='active'){
                $product->sell_kg -= $sell->kg;
                $product->stock_kg += $sell->kg;
                $product->sell_quantity -= $sell->quantity;
                $product->stock_quantity += $sell->quantity;
                $customer->due_amount -= $sell->total_price;
                $sell->status = 'inactive';
            }else{
                $product->sell_kg += $sell->kg;
                $product->stock_kg -= $sell->kg;
                $product->sell_quantity += $sell->quantity;
                $product->stock_quantity -= $sell->quantity;
                $customer->due_amount += $sell->total_price;
                $sell->status = 'active';
            }
            $product->save();
            $customer->save();
            $sell->save();
            $this->alert('success', 'Successfully sell completed');
            $this->dispatchBrowserEvent('selled', ['message' => 'Successfully sell completed!']);
        }

    }
    public function confirmRemoval()
    {
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
    public function delete()
    {
        $sell = Sell::whereIn('id', $this->selections);
        $sell->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'Appointment deleted successfully!']);
    }
    public function updatedSelectall($value)
    {
        if ($value){
            $this->selections = Sell::when($this->startDate, function($query) {
                return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
            })->when($this->endDate, function($query) {
                return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
            })->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate)->pluck('id')->map(fn($id) =>(string) $id);
        }else{
            $this->selections = [];
        }
    }
//    public function activeStatus()
//    {
//        foreach ($this->selections as $key => $selection) {
//            $sell = Sell::find($selection);
//            $sell->status = 'active';
//            $sell->save();
//        }
//        $this->alert('success', 'Successfully activated');
//    }
//    public function inactiveStatus()
//    {
//        foreach ($this->selections as $key => $selection) {
//            $sell = Sell::find($selection);
//            $sell->status = 'inactive';
//            $sell->save();
//        }
//        $this->alert('success', 'Successfully inactivated');
//    }
    public function FilterSerialize($filtername)
    {
        $this->orderBy = $filtername;
        if ($this->serialize==='desc'){
            $this->serialize = 'asc';
        }else{
            $this->serialize = 'desc';
        }
    }
    public function generate_pdf()
    {
        return response()->streamDownload(function () {
            $sells = Sell::when($this->startDate, function($query) {
                return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
            })->when($this->endDate, function($query) {
                return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
            })->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate);
            $setup = Setup::first();
            $pdf = PDF::loadView('pdf.sells', compact('sells', 'setup'));
            return $pdf->stream('document.pdf');
        }, 'sells.pdf');

    }

    public function render()
    {
        $categories = Category::whereStatus('active')->get();
        $customers = User::whereStatus('active')->whereType('customer')->get();
        $products = Product::whereStatus('active')->get();
        $sells = Sell::when($this->startDate, function($query) {
            return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
        })->when($this->endDate, function($query) {
            return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
        })->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate);
        return view('livewire.admin.sell-component', compact('sells', 'categories', 'customers', 'products'));
    }
}
