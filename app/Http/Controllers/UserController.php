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
                    ->orWhereHas('company', function (Builder $query) use ($request) {
                        $query->where('company', 'like', "%{$request->q}%");
                    });
            }
        )
        ->simplePaginate(5);
        $companies = Company::all();
        $pendingUsers = User::where('status', 'PENDING_APPROVAL')->get();
        $approvedUsers = User::where('status', 'APPROVED')->get();
        $rejectedUsers = User::where('status', 'REJECTED')->get();

        return view('users.user-index', compact('users', 'companies','pendingUsers', 'approvedUsers', 'rejectedUsers'));
    }

    public function pendingUsers()
    {
        // Ambil daftar pengguna dengan status "PENDING_APPROVAL"
        $users = User::paginate(5);
        $companies = Company::all();
        $pendingUsers = User::where('status', 'PENDING_APPROVAL')->get();
        $approvedUsers = User::where('status', 'APPROVED')->get();
        $rejectedUsers = User::where('status', 'REJECTED')->get();

        // Tampilkan view dengan passing data daftar pengguna ke view
        return view('users.approval.user-pending', compact('users', 'companies','pendingUsers', 'approvedUsers', 'rejectedUsers'));
    }

    public function approvedUsers()
    {
        // Ambil daftar pengguna dengan status "PENDING_APPROVAL"
        $users = User::paginate(5);
        $companies = Company::all();
        $pendingUsers = User::where('status', 'PENDING_APPROVAL')->get();
        $approvedUsers = User::where('status', 'APPROVED')->get();
        $rejectedUsers = User::where('status', 'REJECTED')->get();

        // Tampilkan view dengan passing data daftar pengguna ke view
        return view('users.approval.user-approved', compact('users', 'companies','pendingUsers', 'approvedUsers', 'rejectedUsers'));
    }

    public function rejectedUsers()
    {
        // Ambil daftar pengguna dengan status "PENDING_APPROVAL"
        $users = User::paginate(5);
        $companies = Company::all();
        $pendingUsers = User::where('status', 'PENDING_APPROVAL')->get();
        $approvedUsers = User::where('status', 'APPROVED')->get();
        $rejectedUsers = User::where('status', 'REJECTED')->get();

        // Tampilkan view dengan passing data daftar pengguna ke view
        return view('users.approval.user-rejected', compact('users', 'companies','pendingUsers', 'approvedUsers', 'rejectedUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.user-create');
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
            'company_id' => $validatedData['company_id'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
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

    // public function showApprovalPage()
    // {
    //     $users = User::where('is_accepted', false)->get();
    //     return view('user-approval', compact('users'));
    // }

    // public function acceptUser(User $user)
    // {
    //     $user->update(['is_accepted' => true]);
    //     return redirect()->route('user.approval')->with('success', 'User has been accepted.');
    // }
}
