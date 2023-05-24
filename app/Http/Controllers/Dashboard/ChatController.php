<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\ChatRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepoInterface\Users\ChatInterface;
use App\Http\Requests\APIs\LoginRequest;
use App\Http\Requests\APIs\RegisterRequest;

class ChatController extends Controller
{
    protected $ChatInterface;

    public function __construct(ChatInterface $ChatInterface)
    {
        $this->ChatInterface = $ChatInterface;
    }

    public function index(Request $request)
    {
        return $this->ChatInterface->index($request);
    }

    public function create(Request $request)
    {
        return $this->ChatInterface->create($request);
    }

    public function store(Request $request)
    {
        return $this->ChatInterface->store($request);
    }

    public function edit(ChatRoom $chat)
    {
        return $this->ChatInterface->edit($chat);
    }

    public function update(Request $request, ChatRoom $chat)
    {
        return $this->ChatInterface->update($request, $chat);
    }

    public function updateStatus(Request $request, ChatRoom $chat)
    {
        return $this->ChatInterface->updateStatus($request, $chat);
    }

    public function destroy(Request $request, ChatRoom $chat)
    {
        return $this->ChatInterface->destroy($request, $chat);
    }
}