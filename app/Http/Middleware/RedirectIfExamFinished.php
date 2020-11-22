<?php

namespace App\Http\Middleware;

use App\Exam;
use Closure;

class RedirectIfExamFinished
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
        $examcode = $request->session()->get('active_exam_code');
        $exam = Exam::where('code', $examcode)->first();
        if ($exam['finished_at']) {
            return redirect('/result/' . $examcode);
        }
        return $next($request);
    }
}
