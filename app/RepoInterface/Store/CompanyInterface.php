<?php

namespace App\RepoInterface\Store;

interface CompanyInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function show($request, $company);
    public function edit($company);
    public function update($request, $company);
    public function destroy($company);
}