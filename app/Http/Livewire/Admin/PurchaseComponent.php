<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Setup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PurchaseComponent extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $startDate, $endDate;
    public $state = [], $purchase, $editmode, $name, $orderBy='id', $serialize='desc', $paginate=10, $search='', $purchaseId, $selectall = false, $selections = [];
    protected $listeners = ['deleteConfirmed' => 'delete', 'purchase_confirmed' => 'purchase_confirmed'];

    protected $paginationTheme = 'bootstrap';
    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form', ['action'=>'show']);
    }
    public function create_purchase()
    {
        $validatedData = Validator::make($this->state, [
            'product_id' => ['required'],
            'category_id' => ['required'],
            'user_id' => ['required'],
            'quantity' => ['required', 'numeric'],
            'kg' => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
            'paid_price' => ['required', 'numeric'],
        ])->validate();
        $validatedData['total_price'] = $validatedData['kg']*$validatedData['unit_price'];
        $validatedData['due_price'] = $validatedData['total_price']-$validatedData['paid_price'];
        if ($validatedData['paid_price']>$validatedData['total_price']) {
            $this->alert('error', 'Paid price must be smaller than total price');
        }else{
            Purchase::create($validatedData);
            $this->dispatchBrowserEvent('show-form', ['action'=>'hide']);
            $this->alert('success', 'Successfully inserted');
        }
    }
    public function Edit(Purchase $purchase)
    {
        $this->reset();
        $this->editmode = true;
        $this->purchase = $purchase;
        $this->state = $purchase->toArray();
        $this->dispatchBrowserEvent('show-form', ['action'=>'show']);
    }

    public function update_purchase()
    {
        $validatedData = Validator::make($this->state, [
            'product_id' => ['required'],
            'category_id' => ['required'],
            'user_id' => ['required'],
            'quantity' => ['required', 'numeric'],
            'kg' => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
            'paid_price' => ['required', 'numeric'],
        ])->validate();
        $validatedData['total_price'] = $validatedData['kg']*$validatedData['unit_price'];
        $validatedData['due_price'] = $validatedData['total_price']-$validatedData['paid_price'];
        if ($validatedData['paid_price']>$validatedData['total_price']) {
            $this->alert('error', 'Paid price must be smaller than total price');
        }else {
            $this->purchase->update($validatedData);
            $this->dispatchBrowserEvent('show-form', ['action' => 'hide']);
            $this->alert('success', 'Successfully updated');
        }
    }
    public function confirm_purchase($id)
    {
        $this->purchaseId = $id;
        $this->dispatchBrowserEvent('show-purchase-confirmation');
    }


    public function purchase_confirmed()
    {
        $purchase = Purchase::find($this->purchaseId);
        $product = $purchase->product;
        $seller = $purchase->seller;
        if ($purchase->status==='active'){
            $product->full_kg -= $purchase->kg;
            $product->stock_kg -= $purchase->kg;
            $product->full_quantity -= $purchase->quantity;
            $product->stock_quantity -= $purchase->quantity;

//            $seller->payable_amount -= $purchase->total_price;
            $purchase->status = 'inactive';
        }else{
            $product->full_kg += $purchase->kg;
            $product->stock_kg += $purchase->kg;
            $product->full_quantity += $purchase->quantity;
            $product->stock_quantity += $purchase->quantity;

//            $seller->payable_amount += $purchase->total_price;
            $purchase->status = 'active';
        }
        $product->save();
        $seller->save();
        $purchase->save();
        $this->alert('success', 'Successfully purchase completed');
        $this->dispatchBrowserEvent('purchased', ['message' => 'Successfully purchase completed!']);

    }
    public function confirmRemoval()
    {
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
    public function delete()
    {
        $purchase = Purchase::whereIn('id', $this->selections);
        $purchase->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'Appointment deleted successfully!']);
    }
    public function updatedSelectall($value)
    {
        if ($value){
            $this->selections = Purchase::when($this->startDate, function($query) {
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
//            $purchase = Purchase::find($selection);
//            $purchase->status = 'active';
//            $purchase->save();
//        }
//        $this->alert('success', 'Successfully activated');
//    }
//    public function inactiveStatus()
//    {
//        foreach ($this->selections as $key => $selection) {
//            $purchase = Purchase::find($selection);
//            $purchase->status = 'inactive';
//            $purchase->save();
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
            $purchases = Purchase::when($this->startDate, function($query) {
                return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
            })->when($this->endDate, function($query) {
                return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
            })->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate);
            $setup = Setup::first();
            $pdf = PDF::loadView('pdf.purchases', compact('purchases', 'setup'));
            return $pdf->stream('document.pdf');
        }, 'purchases.pdf');

    }

    public function render()
    {
        $categories = Category::whereStatus('active')->get();
        $sellers = User::whereStatus('active')->whereType('seller')->get();
        $products = Product::whereStatus('active')->get();
        $purchases = Purchase::when($this->startDate, function($query) {
            return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
        })->when($this->endDate, function($query) {
            return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
        })->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate);
        return view('livewire.admin.purchase-component', compact('purchases', 'categories', 'sellers', 'products'));
    }
}
