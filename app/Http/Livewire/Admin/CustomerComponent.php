<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerComponent extends Component
{
    use WithPagination;
    public $state = [], $customer, $editmode, $name, $orderBy='id', $serialize='desc', $paginate=10, $search='', $customerId, $selectall = false, $selections = [];
    protected $listeners = ['deleteConfirmed' => 'delete'];

    protected $paginationTheme = 'bootstrap';

    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form', ['action'=>'show']);
    }
    public function create_customer()
    {
        $validatedData = Validator::make($this->state, [
            'name' => ['required', 'min:2', 'max:33', Rule::unique('users', 'name')],
            'phone' => ['required', 'min:2', 'max:33', Rule::unique('users', 'phone')],
            'email' => ['nullable', 'email', 'max:44', Rule::unique('users', 'email')],
            'address' => ['nullable', 'max:333'],
        ])->validate();
        $validatedData['type'] = 'customer';
        User::create($validatedData);
        $this->dispatchBrowserEvent('show-form', ['action'=>'hide']);
        $this->alert('success', 'Successfully inserted');
    }
    public function Edit(User $customer)
    {
        $this->reset();
        $this->editmode = true;
        $this->customer = $customer;
        $this->state = $customer->toArray();
        $this->dispatchBrowserEvent('show-form', ['action'=>'show']);
    }

    public function update_customer()
    {
        $validatedData = Validator::make($this->state, [
            'name' => ['required', 'min:2', 'max:33', Rule::unique('users', 'name')->ignore($this->state['id'])],
            'phone' => ['required', 'min:2', 'max:33', Rule::unique('users', 'phone')->ignore($this->state['id'])],
            'email' => ['nullable', 'email', 'max:44', Rule::unique('users', 'email')->ignore($this->state['id'])],
            'address' => ['nullable', 'max:333'],
        ])->validate();
        $this->customer->update($validatedData);
        $this->dispatchBrowserEvent('show-form', ['action'=>'hide']);
        $this->alert('success', 'Successfully updated');
    }

    public function confirmRemoval()
    {
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
    public function delete()
    {
        $customer = User::whereIn('id', $this->selections);
        $customer->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'Appointment deleted successfully!']);
    }
    public function updatedSelectall($value)
    {
        if ($value){
            $this->selections = User::where('name', 'like', '%'.$this->search.'%')->where('type', 'customer')->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate)->pluck('id')->map(fn($id) =>(string) $id);
        }else{
            $this->selections = [];
        }
    }
    public function activeStatus()
    {
        foreach ($this->selections as $key => $selection) {
            $customer = User::find($selection);
            $customer->status = 'active';
            $customer->save();
        }
        $this->alert('success', 'Successfully activated');
    }
    public function inactiveStatus()
    {
        foreach ($this->selections as $key => $selection) {
            $customer = User::find($selection);
            $customer->status = 'inactive';
            $customer->save();
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
    public function render()
    {
        $customers = User::where('name', 'like', '%'.$this->search.'%')->where('type', 'customer')->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate);
        return view('livewire.admin.customer-component', compact('customers'));
    }
}
