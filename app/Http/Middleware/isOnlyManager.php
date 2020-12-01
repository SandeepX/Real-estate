<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isOnlyManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {

            $userRole = Auth::user()->getRoleNames();

            //dd($userRole->contains($role));

            if ($userRole->contains('Manager') ){
                //dd('afag');
                return $next($request);

            }
            else{
                //dd($role);
                abort(403, 'You Don\'t Have Right Permissions.');
            }

        }
        else{
            return redirect()->route('fe.login');
        }
    }
}
