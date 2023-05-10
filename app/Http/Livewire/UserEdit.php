<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Department;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserEdit extends Component
{
    public $name;
    public $email;
    public $user_id;
    public $password;
    public bool $is_agent = false;
    public bool $is_verified = true;
    public array $departments = [];

    public function mount(int $id) {
        $user = User::with('roles:id,name')
            ->with('departments:id,name')
            ->where('id', $id)
            ->first(['id', 'name', 'email', 'email_verified_at']);

        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->is_verified = $user->email_verified_at ? true : false;
        $this->is_agent = $user->roles->contains('name', 'agent');

        if($this->is_agent) {
            $this->departments = $user->departments->modelKeys();
        }
    }

    public function render()
    {
        $departments = Department::select(['id', 'name'])->get();
        return view('livewire.user-edit', ['all_departments' => $departments]);
    }

    public function save()
    {
        $data = $this->validate();

        $user = User::find($this->user_id);

        $data['email_verified_at'] = $this->is_verified ? $this->email_verified_at ?? now() : null;

        if(!$data['password']) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        if($this->is_agent) {
            $user->syncRoles('agent');
            $user->departments()->sync($this->departments);
        } else {
            $user->removeRole('agent');
            $user->departments()->sync([]);
        }

        session()->flash('status', 'Usuário atualizado.');

        // $this->reset('is_verified', 'is_agent');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => ['nullable', Rules\Password::defaults()],
            'is_agent' => 'required|boolean',
            'is_verified' => 'required|boolean',
        ];
    }
}
