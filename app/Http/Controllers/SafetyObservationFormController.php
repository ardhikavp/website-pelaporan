<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\SafetyObservationForm;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class SafetyObservationFormController extends Controller
{
    public function __construct()
    {
        // $this->middleware('admin')->except('store');
        // $this->middleware('SHE')->except('approveSafetyObservation');
        // $this->middleware('pegawai')->except(['reviewSafetyObservation', 'approveSafetyObservation']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $forms = SafetyObservationForm::paginate(5);
        $user = Auth::user();

        if ($user->role === 'SHE' || $user->role === 'admin') {
            // Fetch all safety observation forms without restricting by company for 'SHE' and 'admin' users.
            $forms = SafetyObservationForm::paginate(5);
        } else {
            // Fetch the company ID of the authenticated user.
            $companyId = $user->company->id;

            // Get the safety observation forms that belong to the company of the authenticated user and paginate the results.
            $forms = SafetyObservationForm::where('company_id', $companyId)->paginate(5);
        }

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
        ]);

        $user = auth()->user();

        // check if role is SHE and update data accordingly
        $defaultStatus = 'PENDING_REVIEW';
        $defaultReviewedBy = null;
        if ($user->role == 'SHE') {
            $defaultStatus = 'PENDING_APPROVAL';
            $defaultReviewedBy = $user->id;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $imagePath = public_path('images'); // Use public_path() to get the full storage path

            // Memindahkan image ke file public/images
            $image->move($imagePath, $fileName);

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
            'status' => $defaultStatus,
            'reviewed_by' => $defaultReviewedBy,
            'approved_by' => null
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

    public function reviewSafetyObservation(SafetyObservationForm $forms)
    {
        // Assuming you have authenticated the reviewer user.
        $reviewer = auth()->user();

        // Perform any checks to ensure the user is authorized to review the form.

        // For example, check user roles or permissions here.

        // Update the review status of the form to "Reviewed" (you can adjust this status according to your needs).
        $forms->status = 'Reviewed';
        $forms->save();

        // Associate the reviewer with the form.
        $forms->reviewer()->associate($reviewer);
        $forms->save();

        // Redirect back or perform any other action as needed.
        return redirect()->back()->with('success', 'Safety Observation Form reviewed successfully.');
    }

    public function approveSafetyObservation(SafetyObservationForm $forms)
    {
    }
}
