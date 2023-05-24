<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepoInterface\Users\UserInterface;

class UserController extends Controller
{
    protected $UserInterface;

    public function __construct(UserInterface $UserInterface)
    {
        $this->UserInterface = $UserInterface;
    }

    public function index(Request $request)
    {
        return $this->UserInterface->index($request);
    }

    public function create()
    {
        return $this->UserInterface->create();
    }

    public function store(Request $request)
    {
        return $this->UserInterface->store($request);
    }

    public function sendNotify(Request $request)
    {
        return $this->UserInterface->sendNotify($request);
    }

    public function best(Request $request)
    {
        return $this->UserInterface->best($request);
    }

    public function post_best(Request $request)
    {
        return $this->UserInterface->post_best($request);
    }

    public function delete_best(Request $request)
    {
        return $this->UserInterface->delete_best($request);
    }

    public function show(User $user)
    {
        return $this->UserInterface->show($user);
    }

    public function edit(User $user)
    {
        return $this->UserInterface->edit($user);
    }

    public function update(Request $request, User $user)
    {
        return $this->UserInterface->update($request, $user);
    }

    public function destroy(User $user)
    {
        return $this->UserInterface->destroy($user);
    }
}