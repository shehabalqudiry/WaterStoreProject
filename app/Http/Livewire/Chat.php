<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Announcement;
use App\Models\Chat as ModelChat;

class Chat extends Component
{
    public $chatId;
    public $msg;
    public $user;
    public $user_id;
    public $chat_show = 0;

    public function __construct($user_id = null)
    {
        $this->user = auth()->user();
        if (request()->user_id && request()->announcement_number) {
            $user_id = request()->user_id;
            $chat1 = ModelChat::where('user_id', $this->user->id)
                                ->where('sender_id', $user_id)->first();

            $chat2 = ModelChat::where('user_id', $user_id)
                                ->where('sender_id', $this->user->id)
                                ->first();
            // dd(!$chat1 && !$chat2);
            $chat = !$chat1 ? $chat2 : $chat1;
            if (!$chat) {
                $chat = ModelChat::create([
                    'sender_id' => $this->user->id,
                    'user_id' => $user_id,
                ]);
            }
            $chat->messages()->create([
                'sender_id' => $this->user->id,
                'user_id' => $user_id,
                'message'   => "<a class='font-2' style='color: #fff' href='".route('front.announcements.show', request()->announcement_number) . "'><h6>". (Announcement::where('number', request()->announcement_number)->first()->title ?? '') . "<br /><br />" . __('lang.Announcement Code'). " : " .request()->announcement_number."</h6></a>"
            ]);
            $this->user_id = $user_id;
            // dd($user_id);
            $this->chatId = $chat;
            $this->chat_show = 1;
        }
    }

    // public function updating()
    // {
    //     $this->emit('update');
    // }

    protected $rules = [
        'msg' => 'alpha',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function chatShow($user_id)
    {
        $this->user_id = $user_id;
        $chat = ModelChat::where('user_id', $this->user->id)
                            ->orWhere('sender_id', $this->user->id)
                            ->where('user_id', $user_id)
                            ->orWhere('sender_id', $user_id)
                            ->first();

        $this->chatId = $chat;
        $this->chat_show = 1;
        $this->emit('update');
    }

    public function delete($id)
    {
        $this->chat_show = 0;
        $this->chatId = '';
        $chat = ModelChat::find($id)->delete();
        // $this->$refresh;
    }

    public function send_msg()
    {
        $msg = $this->validate();
        $this->chatId->messages()->create([
            'message'       => $msg['msg'],
            'sender_id'     => $this->user->id,
            'user_id'       => $this->user_id,
        ]);
        $this->emit('update');
        $this->msg = '';
    }
    public function render()
    {
        $chats = ModelChat::where('user_id', $this->user->id)->orWhere('sender_id', $this->user->id)->with('messages', 'sender', 'user')->get();
        return view('livewire.chat', ['chats' => $chats]);
    }
}
