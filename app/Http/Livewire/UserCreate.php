<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Department;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserCreate extends Component
{
    public $name;
    public $email;
    public $password;
    public bool $is_agent = false;
    public bool $is_verified = true;
    public array $departments = [];


    public function render()
    {
        $departments = Department::select(['id', 'name'])->get();
        return view('livewire.user-create', ['all_departments' => $departments]);
    }

    public function save()
    {
        $data = $this->validate();
        $data['email_verified_at'] = $this->is_verified ? now() : null;
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if($this->is_agent) {
            $user->assignRole('agent');
            $user->departments()->sync($this->departments);
        }

        session()->flash('status', 'Usuário criado.');

        $this->reset();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => ['required', Rules\Password::defaults()],
            'is_agent' => 'required|boolean',
            'is_verified' => 'required|boolean',
        ];
    }
}
