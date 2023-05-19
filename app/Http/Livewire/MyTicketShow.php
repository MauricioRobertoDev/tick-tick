<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\Ticket;
use Livewire\Component;

class MyTicketShow extends Component
{
    public Ticket $ticket;
    public Message $message;
    public bool $showModal = false;

    public function mount(int $id)
    {
        $this->ticket = Ticket::query()->with('department:id,name')->findOrFail($id);
    }

    public function render()
    {
        $messages =  $this->ticket->messages()->orderBy('created_at', 'desc')->get();
        return view('livewire.my-ticket-show', ['messages' => $messages]);
    }

    public function save()
    {
        $this->validate();
        $this->message->ticket_id = $this->ticket->id;
        $this->message->user_id = auth()->user()->id;
        $this->message->save();
        $this->reset(['showModal']);
    }

    public function openModal()
    {
        $this->showModal = true;
        $this->message = new Message();
    }

    protected function rules(): array
    {
        return [
            'message.content' => 'required|string'
        ];
    }
}
