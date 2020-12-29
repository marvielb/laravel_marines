<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Facades\Exam\ExamFacade;

class ExamConfirmationController extends Controller
{
    public function index()
    {
        return view('exam.confirm');
    }

    public function edit(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|exists:exams'
        ]);

        Session::put('active_exam_code', $validated['code']);
        ExamFacade::startExam($validated['code']);
    }
}
