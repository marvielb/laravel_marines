<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Exam\ExamFacade;


class ExamCodeGeneratorController extends Controller
{
    public function create()
    {
        return view('exam.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'marine_number' => 'required|exists:users,marine_number'
        ]);

        $exam = ExamFacade::generateExamFor($validated['marine_number']);
        return $exam;
    }
}
