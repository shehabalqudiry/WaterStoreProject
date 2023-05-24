<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    use GeneralTrait;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->is('api') || $request->is('api/*')) {
                return "سجل دخولك اولا";
            }
            return route('login');
        }
    }
}
