<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Policies\CompanyPolicy;

class CompanyController extends Controller
{

    public function index()
    {
        $companies = Company::withCount('users')->paginate(5);

        $safetyIndex = Company::leftJoin('answers', 'companies.id', '=', 'answers.company_id')
        ->where('answers.status', 'APPROVED')
        ->select('companies.id', DB::raw('COALESCE(AVG(answers.safety_index), 0) as average_safety_index'))
        ->groupBy('companies.id')
        ->get();

    // dd($safetyIndex);

    return view('companies.company-index', compact('safetyIndex', 'companies'));
}

    public function create()
    {
        return view('companies.company-create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company' => 'required|unique:companies|max:255',
        ]);

        $company = Company::create($validatedData);

        return redirect()->route('companies.index')->with('success', 'Perusahaan berhasil ditambahkan.');
    }

    public function edit(Company $company)
    {
        return view('companies.company-edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'company' => 'required|unique:companies|max:255',
        ]);

        $company->update($validatedData);

        return redirect()->route('companies.index')->with('success', 'Perusahaan berhasil diedit.');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Perusahaan berhasil dihapus.');
    }

    public function getEmployeeCountByCompany($companyId)
    {
        return User::where('company_id', $companyId)->count();
    }
}
