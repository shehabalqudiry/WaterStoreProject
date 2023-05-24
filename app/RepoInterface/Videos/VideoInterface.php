<?php

namespace App\RepoInterface\Videos;


interface VideoInterface
{
    public function index($request);
    public function uploadToServer($request);
    public function create();
    public function store($request);
    public function show($request);
    public function edit($video);
    public function update($request,$video);
    public function updateStatus($request,$video);
    public function destroy($video);
}
