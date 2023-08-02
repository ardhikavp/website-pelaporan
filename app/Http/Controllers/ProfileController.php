<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) // TODO: remove param
    {
        $user = auth()->user(); // get current login user
        $company = $user->company;

        return view('profiles.profile-show', compact('user', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $company = Company::findOrFail($user->company_id); // Assuming the foreign key is 'company_id' in the User model

        return view('profiles.profile-edit', compact('user', 'company'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        $company = Company::findOrFail($user->company_id); // Assuming the foreign key is 'company_id' in the User model
        $company->update(['company' => $request->input('company')]);
        if ($request->has('email')) {
            // Update the email if it's different from the current email
            if ($request->input('email') !== $user->email) {
                $user->update(['email' => $request->input('email')]);
            }
        }
        return redirect()->route('profile.show', ['profile' => $id])->with('message', 'Profile updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
