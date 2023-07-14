<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SafetyObservationForm;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class SafetyObservationFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = SafetyObservationForm::all();

        return view('safety-observation-forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        $users = User::all();
        return view('safety-observation-forms.create', compact('locations', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_laporan' => 'required',
            'date_finding' => 'required',
            'location_id' => 'required',
            'safety_observation_type' => 'required',
            'hazard_potential' => 'required',
            'impact' => 'required',
            'short_term_recommendation' => 'required',
            'middle_term_recommendation' => 'required',
            'long_term_recommendation' => 'required',
            'completation_date' => 'required',
            'created_by' => 'required',
            'approved_by' => 'required',
        ]);

        $location = Location::find($validatedData['location_id']);

        $validatedData['location'] = $location;

        $form = SafetyObservationForm::create($validatedData);


        Session::flash('message', 'Form created successfully.');

        return Redirect::route('safety-observation-forms.show', $form->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(SafetyObservationForm $form)
    {
        return view('safety-observation-forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SafetyObservationForm $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SafetyObservationForm $form)
    {
        $validatedData = $request->validate([
            'nomor_laporan' => 'required',
            'date_finding' => 'required',
            'location_id' => 'required',
            'safety_observation_type' => 'required',
            'hazard_potential' => 'required',
            'impact' => 'required',
            'short_term_recommendation' => 'required',
            'middle_term_recommendation' => 'required',
            'long_term_recommendation' => 'required',
            'completation_date' => 'required',
            'created_by' => 'required',
            'approved_by' => 'required',
        ]);

        $form->update($validatedData);

        Session::flash('message', 'Form updated successfully.');

        return Redirect::route('safety-observation-forms.show', $form->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SafetyObservationForm $form)
    {
        $form->delete();

        Session::flash('message', 'Form deleted successfully.');

        return Redirect::route('safety-observation-forms.index');
    }
}
