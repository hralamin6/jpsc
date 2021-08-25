<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ProfileComponent extends Component
{
    public $email, $name, $phone, $address, $image, $password, $newPassword;
    public function rules()
    {
        return [
            'image' => 'required|url',
            'phone' => 'numeric',
            'address' => 'nullable',
            'name' => 'required|min:4|max:22',
            'email' => ['required', 'min:4', 'max:222', Rule::unique('users', 'email')->ignore(Auth::id())]
        ];
    }
    public function mount()
    {
        $user = User::find(Auth::id());
        $this->email = $user->email;
        $this->image = $user->profile_photo_path;
        $this->address = $user->address;
        $this->phone = $user->phone;
        $this->name = $user->name;
    }
    public function getDetails()
    {
        $user = User::find(Auth::id());
        $this->email = $user->email;
        $this->image = $user->profile_photo_path;
        $this->address = $user->address;
        $this->phone = $user->phone;
        $this->name = $user->name;
    }
    public function Update()
    {
        $this->validate();
        $user = user::find(Auth::id());
        $user->email = $this->email;
        $user->profile_photo_path = $this->image;
        $user->address = $this->address;
        $user->phone = $this->phone;
        $user->name = $this->name;
        $user->save();
        $this->reset();
        $this->alert('success', 'Successfully updated');
        $this->getDetails();
    }

    public function ChangePassword()
    {
        $this->validate([
            'password' => 'required|password',
            'newPassword' => 'required|min:4|max:22',
        ]);
        $user = user::find(Auth::id());
        $user->password = Hash::make($this->newPassword);
        $user->save();
        $this->reset();
        $this->alert('success', 'Successfully updated password');
        $this->getDetails();
    }
    public function render()
    {
        $user = User::find(Auth::id());

        return view('livewire.admin.profile-component',compact('user'));
    }
}
