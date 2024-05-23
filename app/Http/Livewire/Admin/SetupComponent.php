<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setup;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SetupComponent extends Component
{
    use LivewireAlert;

    public $nightMode, $sidebarCollapse;
    public $state = [];

    public function mount()
    {

    }

    public function updateSetting()
    {
        $this->validate([
            'state.logo' => 'url',
            'state.site_url' => 'url',
            'state.admin' => 'required',
            'state.email' => 'email',
            'state.phone' => 'numeric',
            'state.location' => 'nullable',
            'state.facebook' => 'url',
            'state.twitter' => 'url',
            'state.youtube' => 'url',
            'state.about' => 'nullable',
            'state.site_name' => ['required', 'min:4', 'max:222']

        ]);
        $setup = Setup::first();
        $setup->logo = $this->state['logo'];
        $setup->site_url = $this->state['site_url'];
        $setup->admin = $this->state['admin'];
        $setup->site_name = $this->state['site_name'];
        $setup->email = $this->state['email'];
        $setup->phone = $this->state['phone'];
        $setup->location = $this->state['location'];
        $setup->facebook = $this->state['facebook'];
        $setup->twitter = $this->state['twitter'];
        $setup->youtube = $this->state['youtube'];
        $setup->about = $this->state['about'];
        $setup->save();
        $this->alert('success', 'Successfully updated');
    }
    public function updatednightMode()
    {
        if ($this->nightMode==true) {
            Session::put('nightMode', true);
        }else{
            if (Session::has('nightMode')) {
                Session::forget('nightMode');
            }
        }
        $this->alert('success', 'Successfully updated');
    }
    public function updatedsidebarCollapse()
    {
        if ($this->sidebarCollapse==true) {
            Session::put('sidebarCollapse', true);
        }else{
            if (Session::has('sidebarCollapse')) {
                Session::forget('sidebarCollapse');
            }
        }
        $this->alert('success', 'Successfully updated');
    }
    public function render()
    {
        if (Session::has('nightMode')) {
            $this->nightMode = true;
        }
        if (Session::has('sidebarCollapse')) {
            $this->sidebarCollapse = true;
        }
        $setting = Setup::first();

        if ($setting) {
            $this->state = $setting->toArray();
        }

        return view('livewire.admin.setup-component');
    }
}
