<?php

namespace App\Http\Livewire;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function mount()
    {
        if (Auth::check()){
            return redirect()->route('home');
        }
    }
    public function authenticate()
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));

            return;
        }

        return redirect()->intended(route('home'));
    }

    public function asdf()
    {

        dd('asdf');
    }
    public function render()
    {

        return view('livewire.login-component')->layout('layouts.base');
    }
}
