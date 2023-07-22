<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Answer;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\SafetyBehaviorChecklist;

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
        $data = SafetyBehaviorChecklist::all();
        $answers = Answer::all();
        $companies = Company::all();

        return view('safety-behavior-checklists.safety-behavior-checklist-create', [
            'safetyList' => $data,
            'answers' => $answers,
            'companies' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Menyimpan data jawaban
        $questions = $request->input('question');
        $answers = $request->input('answer');

        $question_answer_collection = [];

        foreach ($answers as $category => $question_ids) {
            $item_to_be_added = ["category" => $category, "question_answers" => []];
            foreach ($question_ids as $question_id => $answer) {
                $item_to_be_added["question_answers"][] = [
                    "question_id" => $question_id,
                    "question" => $questions[$category][$question_id],
                    "answer" => $answer
                ];
            }
            $question_answer_collection[] = $item_to_be_added;
        }

        // Menghitung safety index
        $safeCount = 0;
        $unsafeCount = 0;
        $naCount = 0;

        foreach ($answers as $category => $questionIds) {
            foreach ($questionIds as $questionId => $answer) {
                if ($answer === 'safe') {
                    $safeCount++;
                } elseif ($answer === 'unsafe') {
                    $unsafeCount++;
                } elseif ($answer === 'n/a') {
                    $naCount++;
                }
            }
        }
        $totalAnswers = $safeCount + $unsafeCount;

        $safetyIndex = $totalAnswers > 0 ? ($safeCount / $totalAnswers) * 100 : 0;

        // Membuat nomot laporan
        // Ambil bulan dan tahun saat ini
        $now = Carbon::now();
        $month = $now->format('m');
        $year = $now->format('Y');

        // Ambil laporan terakhir dalam bulan tersebut
        $lastReport = Answer::whereMonth('created_at', '=', $month)
            ->whereYear('created_at', '=', $year)
            ->orderByDesc('id')
            ->first();

        // Buat nomor laporan berikutnya
        if ($lastReport) {
            $lastNumber = intval(substr($lastReport->nomor_laporan, 0, 3));
            $newNumber = $lastNumber + 1;
            $nomorLaporan = str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $nomorLaporan = '001';
        }

        // Ambil singkatan perusahaan dari input
        $companyId = $request->input('company_id');
        $companyName = Company::find($companyId)->company;
        $abbreviation = '';

        $words = explode(" ", $companyName);

        foreach ($words as &$word) {
            preg_match_all('/[A-Z]/', $word, $matches);
            $abbreviation .= implode("", $matches[0]);
        }

        $abbreviation = str_pad($abbreviation, 5);

        // Buat string nomor laporan
        $nomorLaporanString = $nomorLaporan . '/' . 'SBC' . '/' . $abbreviation . '/' . $month . '/' . $year;

        Answer::create([
            'user_id' => auth()->user()->id,
            'date_finding' => $request->input('date_finding'),
            'operation_name' => $request->input('operation_name'),
            'company_id' => $request->input('company_id'),
            'answer' => json_encode($question_answer_collection),
            'safety_index' => $safetyIndex,
            'nomor_laporan' => $nomorLaporanString,
        ]);

        // Redirect ke halaman yang diinginkan (misalnya halaman indeks checklist)
        return redirect()->route('safety-behavior-checklist.index')->with('success', 'Safety Behavior Checklist created successfully.');
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {

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
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return redirect()->route('safety-behavior-checklist.index')->with('success', 'Safety Behavior Checklist berhasil dihapus.');
    }

    // public function getOperationNames(Request $request)
    // {
    //     $query = $request->query('q');
    //     $operationNames = DB::table('answers')
    //         ->where('operation_name', 'like', "%{$query}%")
    //         ->pluck('operation_name');

    //     return response()->json($operationNames);
    // }
}
