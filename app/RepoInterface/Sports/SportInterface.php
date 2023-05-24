<?php

namespace App\RepoInterface\Sports;


interface SportInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function show($request);
    public function edit($sport);
    public function update($request,$sport);
    public function destroy($sport);
}
