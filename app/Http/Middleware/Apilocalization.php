<?php

namespace App\Http\Middleware;

use Closure;

class Apilocalization
{

  /**
  * Handle an incoming request.
  *
  * @param \Illuminate\Http\Request $request
  * @param \Closure $next
  * @return mixed
  */

  public function handle($request, Closure $next)
  {

     // Check header request and determine localizaton
     $local = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';

     // set laravel localization
     app()->setLocale($local);

    // continue request
    return $next($request);
  }
}
