<?php

namespace App\Http\Controllers;

use App\QuestionClassification;
use Illuminate\Http\Request;
use Pager;

class QuestionClassificationController extends Controller
{
    use Pager;

    public function tableName()
    {
        return 'question_classifications';
    }

    public function index()
    {
        return view('questionclassification.index');
    }

    public function all()
    {
        return QuestionClassification::all();
    }


    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'description' => 'required|unique:question_classifications'
        ]);
        return QuestionClassification::create($validatedRequest);
    }

    public function show(QuestionClassification $questionclassification)
    {
        abort(404);
    }


    public function edit(QuestionClassification $questionclassification)
    {
        return $questionclassification;
    }

    public function update(Request $request, QuestionClassification $questionclassification)
    {
        $validatedRequest = $request->validate([
            'description' => 'required|unique:question_classifications,description,' . $questionclassification['id']
        ]);

        return $questionclassification->update($validatedRequest);
    }


    public function destroy(QuestionClassification $questionclassification)
    {
        $questionclassification->delete();
    }
}
