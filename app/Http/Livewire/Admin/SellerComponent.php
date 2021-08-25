<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sell;
use App\Models\Setup;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class SellerComponent extends Component
{
    use WithPagination;
    public $state = [], $seller, $editmode, $name, $orderBy='id', $serialize='desc', $paginate=10, $search='', $sellerId, $selectall = false, $selections = [];
    protected $listeners = ['deleteConfirmed' => 'delete'];

    protected $paginationTheme = 'bootstrap';
    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form', ['action'=>'show']);
    }
    public function create_seller()
    {
        $validatedData = Validator::make($this->state, [
            'name' => ['required', 'min:2', 'max:33', Rule::unique('users', 'name')],
            'phone' => ['required', 'min:2', 'max:33', Rule::unique('users', 'phone')],
            'email' => ['nullable', 'email', 'max:44', Rule::unique('users', 'email')],
            'address' => ['nullable', 'max:333'],
        ])->validate();
        $validatedData['type'] = 'seller';
        User::create($validatedData);
        $this->dispatchBrowserEvent('show-form', ['action'=>'hide']);
        $this->alert('success', 'Successfully inserted');
    }
    public function Edit(User $seller)
    {
        $this->reset();
        $this->editmode = true;
        $this->seller = $seller;
        $this->state = $seller->toArray();
        $this->dispatchBrowserEvent('show-form', ['action'=>'show']);
    }

    public function update_seller()
    {
        $validatedData = Validator::make($this->state, [
            'name' => ['required', 'min:2', 'max:33', Rule::unique('users', 'name')->ignore($this->state['id'])],
            'phone' => ['required', 'min:2', 'max:33', Rule::unique('users', 'phone')->ignore($this->state['id'])],
            'email' => ['nullable', 'email', 'max:44', Rule::unique('users', 'email')->ignore($this->state['id'])],
            'address' => ['nullable', 'max:333'],
        ])->validate();
        $this->seller->update($validatedData);
        $this->dispatchBrowserEvent('show-form', ['action'=>'hide']);
        $this->alert('success', 'Successfully updated');
    }

    public function confirmRemoval()
    {
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
    public function delete()
    {
        $seller = User::whereIn('id', $this->selections);
        $seller->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'Appointment deleted successfully!']);
    }
    public function updatedSelectall($value)
    {
        if ($value){
            $this->selections = User::where('name', 'like', '%'.$this->search.'%')->where('type', 'seller')->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate)->pluck('id')->map(fn($id) =>(string) $id);
        }else{
            $this->selections = [];
        }
    }
    public function activeStatus()
    {
        foreach ($this->selections as $key => $selection) {
            $seller = User::find($selection);
            $seller->status = 'active';
            $seller->save();
        }
        $this->alert('success', 'Successfully activated');
    }
    public function inactiveStatus()
    {
        foreach ($this->selections as $key => $selection) {
            $seller = User::find($selection);
            $seller->status = 'inactive';
            $seller->save();
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
            $sellers = User::where('name', 'like', '%'.$this->search.'%')->where('type', 'seller')->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate);
           $setup = Setup::first();
            $pdf = PDF::loadView('pdf.sellers', compact('sellers', 'setup'));
            return $pdf->stream('document.pdf');
        }, 'sellers.pdf');

    }
    public function render()
    {

        $sellers = User::where('name', 'like', '%'.$this->search.'%')->where('type', 'seller')->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate);
        return view('livewire.admin.seller-component', compact('sellers'));
    }
}
