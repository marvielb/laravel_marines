<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfExamCodeSet
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
        if ($request->session()->get('active_exam_code')) {
            return redirect('/examsheet');
        }
        return $next($request);
    }
}
