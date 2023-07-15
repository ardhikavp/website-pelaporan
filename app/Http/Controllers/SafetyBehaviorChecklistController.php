<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SafetyBehaviorChecklist;
use Illuminate\Support\Facades\Log;

class SafetyBehaviorChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SafetyBehaviorChecklist::all();
        $answers = Answer::all();
        $companies = Company::all();

        return view('safety-behavior-checklists.safety-behavior-checklist-index', ['safetyList' => $data, 'answers' => $answers, 'companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $questions = $request->input('question');
        $answers = $request->input('answer');

        $question_answer_collection = [];

        foreach ($answers as $category => $question_ids) {
            $item_to_be_added = ["category" => $category];
            foreach ($question_ids as $question_id => $answer) {
                $item_to_be_added[] = [
                    "question_id" => $question_id,
                    "question" => $questions[$category][$question_id],
                    "answer" => $answer
                ];
            }
            $question_answer_collection[] = $item_to_be_added;
        }

        Answer::create([
            'user_id' => auth()->user()->id,
            'operation_name' => $request->input('operation_name'),
            'company_id' => $request->input('company_id'),
            'answer' => json_encode($question_answer_collection)
        ]);

        // Redirect ke halaman yang diinginkan (misalnya halaman indeks checklist)
        return redirect()->route('safety-behavior-checklist.index')->with('success', 'Safety Behavior Checklist created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
