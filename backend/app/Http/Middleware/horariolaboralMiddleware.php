<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;

class horariolaboralMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $now = carbon::now();
        $now = $now->toTimeString();

      if ($now >='20:00:00' ) {
          return response([
        'message'=>'no puedes ver horarios a esta hora '
       ]);
       }  else if($now <'20:00:00'){
      
        return $next($request);
      
       }
      
        
     
       
      
 
       
    }
}
