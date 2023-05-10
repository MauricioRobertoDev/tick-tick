<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    public bool $showDeleteModal = false;
    public int $deleteUserId = 0;

    public function render()
    {
        $users = User::with('roles:id,name')
            ->doesntHave('roles')
            ->orWhereHas("roles", fn($q) => $q->where("name", "agent"))
            ->orderBy('created_at', 'desc')
            ->paginate(20, ['id', 'name', 'email', 'avatar']);

        return view('livewire.user-index', ['users' => $users]);
    }

    public function delete()
    {
        User::findOrFail($this->deleteUserId)->delete();
        session()->flash('status', 'Usuário excluído.');
        $this->reset('showDeleteModal', 'deleteUserId');
    }

    public function showDeleteModal($id)
    {
        $this->showDeleteModal = true;
        $this->deleteUserId = $id;
    }
}
