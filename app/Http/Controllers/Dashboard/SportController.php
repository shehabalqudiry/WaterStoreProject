<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Sport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepoInterface\Sports\SportInterface;

class SportController extends Controller
{
    protected $SportInterface;

    public function __construct(SportInterface $SportInterface)
    {
        return $this->SportInterface = $SportInterface;
    }

    public function index(Request $request)
    {
        return $this->SportInterface->index($request);
    }

    public function create()
    {
        return $this->SportInterface->create();
    }

    public function store(Request $request)
    {
        return $this->SportInterface->store($request);
    }

    public function show(Sport $sport)
    {
        return $this->SportInterface->show($sport);
    }

    public function edit(Sport $sport)
    {
        return $this->SportInterface->edit($sport);
    }

    public function update(Request $request, Sport $sport)
    {
        return $this->SportInterface->update($request, $sport);
    }

    public function destroy(Sport $sport)
    {
        return $this->SportInterface->destroy($sport);
    }
}
