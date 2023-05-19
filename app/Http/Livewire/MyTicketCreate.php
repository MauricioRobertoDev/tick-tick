<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Ticket;
use Livewire\Component;

class MyTicketCreate extends Component
{

    public string $subject = '';
    public string $description = '';
    public int $department = 0;

    public function render()
    {
        $all_departments = Department::select(['id', 'name'])->get();

        return view('livewire.my-ticket-create', ['all_departments' => $all_departments]);
    }

    public function save()
    {
        $data = $this->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'required|int|exists:departments,id',
        ]);

        $data['department_id'] = $data['department'];

        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->tickets()->create($data);

        session()->flash('toast', ['type' => 'success', 'message' => 'Ticket criado.']);

        return redirect()->to(route('myticket.index'));
    }
}
