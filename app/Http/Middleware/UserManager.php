<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role=null)
    {
        //dd($role);


        if (Auth::check()) {

            $userRole = Auth::user()->getRoleNames();

            //dd($userRole->contains($role));


            //yo chai halney ho paxi
          /*  if ($userRole->contains('User') && $userRole->contains('Manager') ){
                //dd('afag');
                return $next($request);
            }*/

            if ($userRole->contains('User') || $userRole->contains('Manager') ){
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
