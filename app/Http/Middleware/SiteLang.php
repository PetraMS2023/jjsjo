<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Session;

class SiteLang {
  public function handle($request, Closure $next) {
   if (session()->has('lang')) {
            App::setLocale(session()->get('lang'));
            Carbon::setLocale(session()->get('lang'));
        } else {
            App::setLocale('en');
            Carbon::setLocale('en');
   }
      return $next($request);
  }
}
