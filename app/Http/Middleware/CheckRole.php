<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Get the role from session
        $userRole = session('role');

        // If the user doesn't have the required role, redirect to home
        if ($userRole !== $role) {
            return redirect('/');
        }

        return $next($request);
    }
}
