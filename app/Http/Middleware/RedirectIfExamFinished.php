<?php

namespace App\Http\Middleware;

use App\Exam;
use Closure;
use App\Facades\Exam\ExamFacade;

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
        try {
            if (ExamFacade::isExamFinished($examcode)) {
                return redirect('/result/' . $examcode);
            }
        } catch (\Exception $e) {
            $request->session()->forget('active_exam_code');
            return redirect('/confirm');
        }

        return $next($request);
    }
}
