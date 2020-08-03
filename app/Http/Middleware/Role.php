<?php


namespace App\Http\Middleware;


use App\Traits\FailedResponseTrait;
use Closure;
use Illuminate\Support\Facades\Auth;


class Role
{
    use FailedResponseTrait;
    public function handle($request, Closure $next, ... $roles)
    {
        if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
            return $this->failedResponse('Access Denied.', 401);

        $user = Auth::user();


        foreach ($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            if ($user->hasRole($role))
                return $next($request);
        }

        return $this->failedResponse('Access Denied.', 403);
    }
}
