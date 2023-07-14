<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
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
        $forms = SafetyObservationForm::paginate(5);

        return view('safety-observation-forms.safety-observation-form-index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $images = Image::all();
        $locations = Location::all();
        $users = User::all();
        return view('safety-observation-forms.safety-observation-form-create', compact('locations', 'users', 'images'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
            'hazard_potential' => 'required',
            'impact' => 'required',
            'short_term_recommendation' => 'required',
            'middle_term_recommendation' => 'required',
            'long_term_recommendation' => 'required',
            'completation_date' => 'required',
            'created_by' => 'required',
            'approved_by' => 'required',
            // 'status' => 'required',
        ]);

        // Upload the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time().'_'.$image->getClientOriginalName();
            $imagePath = 'images';

            // Memindahkan image ke file public/$imagePath
            $image->move($imagePath,$fileName);

            // Menyimpan nama file ke kolom image di tabel
            $imageModel = Image::create([
                'image' => $fileName,
            ]);
        } else {
            $imageModel = null;
        }

        // Find the location by ID
        $location = Location::find($validatedData['location_id']);

        $validatedData['location'] = $location;

        $form = SafetyObservationForm::create([
            'nomor_laporan' => $validatedData['nomor_laporan'],
            'date_finding' => $validatedData['date_finding'],
            'location_id' => $validatedData['location_id'],
            'safety_observation_type' => $validatedData['safety_observation_type'],
            'image_id' => $imageModel ? $imageModel->id : null,
            'description' => $validatedData['description'],
            'hazard_potential' => $validatedData['hazard_potential'],
            'impact' => $validatedData['impact'],
            'short_term_recommendation' => $validatedData['short_term_recommendation'],
            'middle_term_recommendation' => $validatedData['middle_term_recommendation'],
            'long_term_recommendation' => $validatedData['long_term_recommendation'],
            'completation_date' => $validatedData['completation_date'],
            'created_by' => $validatedData['created_by'],
            'approved_by' => $validatedData['approved_by'],
            'status' => "APPROVED",
        ]);
        Session::flash('message', 'Form created successfully.');

        return Redirect::route('safety-observation-forms.index', $form->id);
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
            'image_id' => 'required',
            'description' => 'required',
            'hazard_potential' => 'required',
            'impact' => 'required',
            'short_term_recommendation' => 'required',
            'middle_term_recommendation' => 'required',
            'long_term_recommendation' => 'required',
            'completation_date' => 'required',
            'created_by' => 'required',
            'approved_by' => 'required',
            'status' => 'required',
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
