<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Setup;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class CategoryComponent extends Component
{
    use WithPagination;
    public $editmode, $name, $orderBy='id', $serialize='desc', $paginate=10, $search='', $categoryId, $selectall = false, $selections = [];
    protected $listeners = ['deleteConfirmed' => 'delete'];

    protected $paginationTheme = 'bootstrap';
    public function rules()
    {
        if ($this->editmode) {
            return [
                'name' => ['required', 'min:2', 'max:33', Rule::unique('categories', 'name')->ignore($this->categoryId)]
            ];
        }else{
            return[
                'name' => ['required', 'min:2', 'max:33', Rule::unique('categories', 'name')],
            ];
        }
    }
    public function Save()
    {
        $this->validate();
        $category = new Category();
        $category->name = $this->name;
        $category->save();
        $this->name='';
        $this->alert('success', 'Successfully inserted');

    }
    public function Edit(Category $category)
    {
        $this->name = $category->name;
        $this->categoryId = $category->id;
        $this->editmode = true;
    }
    public function Update()
    {
        $this->validate();
        $category = Category::find($this->categoryId);
        $category->name = $this->name;
        $category->save();
        $this->reset( 'name', 'editmode');
        $this->alert('success', 'Successfully updated');

    }

    public function confirmRemoval()
    {
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
    public function delete()
    {
        $category = Category::whereIn('id', $this->selections);
        $category->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'Appointment deleted successfully!']);
    }

    public function updatedSelectall($value)
    {
        if ($value){
            $this->selections = Category::where('name', 'like', '%'.$this->search.'%')->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate)->pluck('id')->map(fn($id) =>(string) $id);
        }else{
            $this->selections = [];
        }

    }

    public function activeStatus()
    {
        foreach ($this->selections as $key => $selection) {
            $category = Category::find($selection);
            $category->status = 'active';
            $category->save();
        }
        $this->alert('success', 'Successfully activated');
    }
    public function inactiveStatus()
    {
        foreach ($this->selections as $key => $selection) {
            $category = Category::find($selection);
            $category->status = 'inactive';
            $category->save();
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
            $categories = Category::where('name', 'like', '%'.$this->search.'%')->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate);
            $setup = Setup::first();
            $pdf = PDF::loadView('pdf.categories', compact('categories', 'setup'));
            return $pdf->stream('document.pdf');
        }, 'categories.pdf');

    }

    public function render()
    {
        $categories = Category::where('name', 'like', '%'.$this->search.'%')->orderBy($this->orderBy, $this->serialize)->paginate($this->paginate);
        return view('livewire.admin.category-component', compact('categories'));
    }
}
