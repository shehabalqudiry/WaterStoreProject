<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\CompanyAttribute;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\RepoInterface\Store\CompanyInterface;


class CompanyController extends Controller
{
    protected $CompanyInterface;

    public function __construct(CompanyInterface $CompanyInterface)
    {
        $this->CompanyInterface = $CompanyInterface;
    }

    public function index(Request $request)
    {
        return $this->CompanyInterface->index($request);
    }

    public function create()
    {
        return $this->CompanyInterface->create();
    }

    public function store(Request $request)
    {
        return $this->CompanyInterface->store($request);
    }

    public function show(Request $request, Company $company)
    {
        return $this->CompanyInterface->show($request, $company);
    }

    public function edit(Company $company)
    {
        return $this->CompanyInterface->edit($company);
    }

    public function update(Request $request, Company $company)
    {
        return $this->CompanyInterface->update($request, $company);
    }

    public function updateStatus(Request $request, Company $company)
    {
        return $this->CompanyInterface->updateStatus($request, $company);
    }

    public function uploadToServer(Request $request)
    {
        return $this->CompanyInterface->uploadToServer($request);
    }

    public function destroy(Company $company)
    {
        return $this->CompanyInterface->destroy($company);
    }
}