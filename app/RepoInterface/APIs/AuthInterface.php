<?php

namespace App\RepoInterface\APIs;

interface AuthInterface
{
    public function register($request);
    public function login($request);
    public function logout($request);
    public function sendReset($request);
    public function checkCode($request);
    public function reset($request);
}
