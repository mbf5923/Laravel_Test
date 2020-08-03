<?php

namespace App\Http\Middleware;

use App\Traits\FailedResponseTrait;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    use FailedResponseTrait;
    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::check())
            return $this->failedResponse('Access Denied.', 401);
        return $next($request);
    }



}
