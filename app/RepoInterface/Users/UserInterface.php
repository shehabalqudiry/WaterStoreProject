<?php

namespace App\RepoInterface\Users;

interface UserInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function show($request);
    public function best($request);
    public function post_best($request);
    public function delete_best($request);
    public function edit($user);
    public function update($request, $user);
    public function destroy($user);
    public function sendNotify($request);
}
