<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class LoginMiddleware
{
    public function handle($request, Closure $next)
    {
        $name = Session::get('blog_user');
        if (empty($name)){
            return redirect('/');
        }
        return $next($request);
    }
}
