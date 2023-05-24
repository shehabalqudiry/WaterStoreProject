<?php

namespace App\RepoInterface\Store;


interface ProductInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function show($request);
    public function edit($user);
    public function update($request,$user);
    public function destroy($user);
}