<?php

namespace App\RepoInterface\Users;

interface ChatInterface
{
    public function index($request);
    // public function add_room_users($request);
    // public function add_room_admins($request);
    public function create($request);
    public function store($request);
    public function edit($chat);
    public function update($request, $chat);
    public function updateStatus($request,$chat);
    public function destroy($request, $chat);
}
