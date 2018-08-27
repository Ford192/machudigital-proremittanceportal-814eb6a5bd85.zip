<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class UserActive
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
      if (Auth::user()->is_active == 0) {
        \Session::flash('info', 'User Credential Not Active!' );
            Auth::logout();
            return redirect('login');
        }

      // if (Auth::user()->isDelete == 1) {
      //   \Session::flash('info-del', 'User Credential is Deleted!' );
      //    Auth::logout();
      //    return redirect('login');
      //   }
        return $next($request);
    }
}
