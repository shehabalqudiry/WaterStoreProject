<div class="row justify-content-center align-items-start">
    {{-- <div id="container"> --}}
    <aside class="col-12 col-lg-4 rounded-4 border card">
        <div class="card-body px-0" wire:poll>
            <h3>{{ __('lang.messages') }}</h3> {{ !$chats->count() ? 'لا توجد' : '' }}
            <ul class="mt-3 pr-0">
                @foreach ($chats as $chat)
                    @if ($chat->messages->count())
                        {{-- @dd($chat->sender->name) --}}
                        <li class="{{ $chat->id == ($chatId ? $chatId->id : 0) ? 'mainBgColor' : '' }} border rounded-2"
                            wire:click="chatShow({{ $chat->sender->id }})">
                            <img src="{{ $chat->sender_id == $user->id ? $chat->user->getUserAvatar() : $chat->sender->getUserAvatar() }}"
                                alt="" width="60" height="60">
                            <div>
                                <h4>{{ $chat->sender_id == $user->id ? $chat->user->name : $chat->sender->name }}</h4>
                            </div>
                            <button class="btn mx-5 font-3 text-danger" wire:click="delete({{ $chat->id }})"><span
                                    class="fal fa-trash"></span></button>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </aside>
    @if ($chat_show == 1 && $chatId)
        <main class="col-12 col-lg-6 card ms-2">
            <ul id="chat" class="card-body" wire:poll>
                @foreach ($chatId->messages as $message)
                    <li class="{{ $message->sender_id == $user->id ? 'me' : 'you' }} my-3">
                        <div class="entete mt-2">
                            <span><img
                                    src="{{ $message->sender_id == $user->id ? $message->sender->getUserAvatar() : $message->user->getUserAvatar() }}"
                                    alt="" width="60" height="60"></span>
                            <span>{{ $message->created_at->diffforhumans() }}</span>
                        </div>
                        <div
                            class="{{ $message->sender_id == $user->id ? 'mainBgColor' : '' }}  border rad14 message text-start">
                            {!! $message->message !!}
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="col-12 my-3">
                <form wire:submit.prevent="send_msg">
                    <input style="width: 80%" wire:model="msg" class="px-3 py-2 border rad14 d-inline-block"
                        placeholder="{{ __('lang.Send') }}">
                    <button class="btn d-inline-block rad14 mainBgColor" type="submit">{{ __('lang.Send') }}</button>
                    @error('msg')
                        <span class="d-block text-danger w-100 py-1">{{ $message }}</span>
                    @enderror
                </form>
            </div>
        </main>
    @endif
</div>
