<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::query()
        ->when(
            $request->q,
            function (Builder $builder) use ($request) {
                $builder->where('name', 'like', "%{$request->q}%")
                    ->orWhere('username', 'like', "%{$request->q}%")
                    ->orWhere('role', 'like', "%{$request->q}%")
                    ->orWhereHas('company', function (Builder $query) use ($request) {
                        $query->where('company', 'like', "%{$request->q}%");
                    });
            }
        )
        ->Paginate(5);

        $companies = Company::all();

        return view('users.user-index', compact('users', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();

        return view('users.user-create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,pegawai,SHE,safety officer,safety representatif,manager maintenance',
            'company_id' => 'required|exists:companies,id',
            'password' => 'required|min:8|confirmed',
        ]);

        // Simpan data pengguna baru ke database
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'company_id' => $request->input('company_id'),
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::findOrFail($id);
        $companies = Company::all();

        return view('users.user-show', compact('users', 'companies'));
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
