<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChatComponent extends Component
{   
    #[Validate('required|min:1')]
    public $message = '';
    public $convo = [];

    public function mount()
    {
        $messages = Message::all();
        foreach($messages as $message)
        {
            $this->convo[] = [
                'username' => $message->user->name,
                'message' => $message->message,
            ];
        }
    }

    #[On('echo:chat-channel,MessageSent')]
    public function listenForMessage($data)
    {
        $this->convo[] = [
            'username' => $data["username"],
            'message' => $data["message"],
        ];
    }

    public function submitMessage()
    {
        $this->validate();
        MessageSent::dispatch(Auth::user(), $this->message);
        $this->reset('message');
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
