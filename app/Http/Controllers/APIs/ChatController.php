<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\APIs\LoginRequest;
use App\RepoInterface\APIs\ChatAPIInterface;
use App\Http\Requests\APIs\RegisterRequest;

class ChatController extends Controller
{
    protected $ChatInterface;

    public function __construct(ChatAPIInterface $ChatInterface)
    {
        return $this->ChatInterface = $ChatInterface;
    }


    public function create_room(Request $request)
    {
        return $this->ChatInterface->create_room($request);
    }

    public function add_room_users(Request $request)
    {
        return $this->ChatInterface->add_room_users($request);
    }

    public function delete_room_user(Request $request)
    {
        return $this->ChatInterface->delete_room_user($request);
    }

    public function add_room_admins(Request $request)
    {
        return $this->ChatInterface->add_room_admins($request);
    }

    public function delete_room_admin(Request $request)
    {
        return $this->ChatInterface->delete_room_admin($request);
    }

    public function rooms(Request $request)
    {
        return $this->ChatInterface->rooms($request);
    }

    public function get_room(Request $request)
    {
        return $this->ChatInterface->get_room($request);
    }

    public function update_room(Request $request)
    {
        return $this->ChatInterface->update_room($request);
    }

    public function delete_room(Request $request)
    {
        return $this->ChatInterface->delete_room($request);
    }
}
