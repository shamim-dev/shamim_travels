<?php namespace App\Http\Middleware;
use Carbon\Carbon;
use Closure;
use App;
use Config;

class Localaization {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->cookie('locale', Config::get('app.locale'));
        App::setLocale($locale);
        Carbon::setLocale($locale);
        return $next($request);
    }
}