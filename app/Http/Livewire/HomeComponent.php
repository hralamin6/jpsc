<?php

namespace App\Http\Livewire;

use App\Models\Setup;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $setup = Setup::first();
        return view('livewire.home-component', compact('setup'))->layout('layouts.demo');
    }
}
