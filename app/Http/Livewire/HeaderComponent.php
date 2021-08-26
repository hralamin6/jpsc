<?php

namespace App\Http\Livewire;

use http\Url;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\Request;

class HeaderComponent extends Component
{
    public $lang = 'en';

    public function ChangeLang()
    {

//        dd(url()->previous());
        if (session()->has('locale')){
            if (session()->get('locale')=='en'){
                App::setLocale('bn');
                session()->put('locale', 'bn');
            }else{
                App::setLocale('en');
                session()->put('locale', 'en');
            }
           return redirect()->to(url()->previous());
        }else{
            App::setLocale($this->lang);
            session()->put('locale', $this->lang);
        }

    }
    public function render()
    {
        if (!session()->has('locale')){
        App::setLocale('en');
        session()->put('locale', 'en');
    }


        return view('livewire.header-component');
    }
}
