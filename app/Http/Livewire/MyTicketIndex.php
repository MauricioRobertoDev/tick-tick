<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MyTicketIndex extends Component
{
    public function render()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $tickets = $user->tickets()->orderBy('created_at', 'desc')->paginate(20);
        return view('livewire.my-ticket-index', ['tickets' => $tickets]);
    }
}
