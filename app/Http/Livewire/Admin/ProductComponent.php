<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\Setup;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ProductComponent extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $state = [], $product, $editmode, $name, $orderBy='id', $serialize='desc', $paginate=10, $search='', $productId, $selectall = false, $selections = [];
    protected $listeners = ['deleteConfirmed' => 'delete'];

    protected $paginationTheme = 'bootstrap';
    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form', ['action'=>'show']);
    }
    public function create_product()
    {
        $validatedData = Validator::make($this->state, [
            'name' => ['required', 'min:2', 'max:33', Rule::unique('products', 'name')],
        ])->validate();

        Product::create($validatedData);
        $this->dispatchBrowserEvent('show-form', ['action'=>'hide']);
        $this->alert('success', 'Successfully inserted');
    }
    public function Edit(Product $product)
    {
        $this->reset();
        $this->editmode = true;
        $this->product = $product;
        $this->state = $product->toArray();
        $this->dispatchBrowserEvent('show-form', ['action'=>'show']);
    }

    public function update_product()
    {
        $validatedData = Validator::make($this->state, [
            'name' => ['required', 'min:2', 'max:33', Rule::unique('products', 'name')->ignore($this->state['id'])],
        ])->validate();
        $this->product->update($validatedData);
        $this->dispatchBrowserEvent('show-form', ['action'=>'hide']);
        $this->alert('success', 'Successfully updated');
    }
    public function confirmRemoval()
    {
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
    public function delete()
    {
        $product = Product::whereIn('id', $this->selections);
        $product->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'Appointment deleted successfully!']);
    }
    public function updatedSelectall($value)
    {
        if ($value){
            $this->selections = Product::where('name', 'like', '%'.$this->search.'%')->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate)->pluck('id')->map(fn($id) =>(string) $id);
        }else{
            $this->selections = [];
        }
    }
    public function activeStatus()
    {
        foreach ($this->selections as $key => $selection) {
            $product = Product::find($selection);
            $product->status = 'active';
            $product->save();
        }
        $this->alert('success', 'Successfully activated');
    }
    public function inactiveStatus()
    {
        foreach ($this->selections as $key => $selection) {
            $product = Product::find($selection);
            $product->status = 'inactive';
            $product->save();
        }
        $this->alert('success', 'Successfully inactivated');
    }
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
            $products = Product::where('name', 'like', '%'.$this->search.'%')->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate);
            $setup = Setup::first();
            $pdf = PDF::loadView('pdf.products', compact('products', 'setup'));
            return $pdf->stream('document.pdf');
        }, 'products.pdf');

    }

    public function render()
    {

        $products = Product::where('name', 'like', '%'.$this->search.'%')->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate);
        return view('livewire.admin.product-component', compact('products'));
    }
}
