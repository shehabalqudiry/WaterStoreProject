<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepoInterface\APIs\AuthInterface;
use App\Http\Requests\APIs\LoginRequest;
use App\Http\Requests\APIs\RegisterRequest;

class AuthController extends Controller
{
    protected $AuthInterface;

    public function __construct(AuthInterface $AuthInterface)
    {
        $this->AuthInterface = $AuthInterface;
    }


    public function register(Request $request)
    {
        return $this->AuthInterface->register($request);
    }

    public function login(Request $request)
    {
        return $this->AuthInterface->login($request);
    }

    public function logout(Request $request)
    {
        return $this->AuthInterface->logout($request);
    }
    public function sendReset(Request $request)
    {
        return $this->AuthInterface->sendReset($request);
    }
    public function checkCode(Request $request)
    {
        return $this->AuthInterface->checkCode($request);
    }
    public function reset(Request $request)
    {
        return $this->AuthInterface->reset($request);
    }
}
