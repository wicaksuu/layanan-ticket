<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;

class Languagelocaliztion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            DB::connection()->getPdo();
            if(!DB::getSchemaBuilder()->hasTable('settings')){

                return $next($request);
            }else{

                \App::setlocale(session()->get('locale') ?? @(DB::table('settings')->where('key', 'default_lang')->first()->value) );
                return $next($request);
            }
        } catch (\Exception $e) {
            return $next($request);
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
