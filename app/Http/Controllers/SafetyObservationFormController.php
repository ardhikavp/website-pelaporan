<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $user = Auth::user();

        $form_pending_review = [];
        $form_pending_approval = [];
        $form_approved = [];
        $form_rejected = [];

        switch ($user->role) {
            case ('admin'):
                $form_approved = SafetyObservationForm::where('status', 'APPROVED')
                ->paginate(5, ['*'], 'approved')
                ->appends(request()->except('approved'));
                $form_rejected = SafetyObservationForm::where('status', 'REJECTED')
                ->paginate(5, ['*'], 'rejected')
                ->appends(request()->except('rejected'));

            case ('manager maintenance'):
                $form_pending_review = SafetyObservationForm::where('status', 'PENDING_REVIEW')
                    ->paginate(5, ['*'], 'pending_review')
                    ->appends(request()->except('pending_review'));
                $form_pending_approval = SafetyObservationForm::where('status', 'PENDING_APPROVAL')
                    ->paginate(5, ['*'], 'pending_approval')
                    ->appends(request()->except('pending_approval'));
                $form_approved = SafetyObservationForm::where('status', 'APPROVED')
                    ->paginate(5, ['*'], 'approved')
                    ->appends(request()->except('approved'));
                $form_rejected = SafetyObservationForm::where('status', 'REJECTED')
                    ->paginate(5, ['*'], 'rejected')
                    ->appends(request()->except('rejected'));
                break;

            case ('SHE'):
                $form_pending_review = SafetyObservationForm::where('status', 'PENDING_REVIEW')
                    ->paginate(5, ['*'], 'pending_review')
                    ->appends(request()->except('pending_review'));
                $form_pending_approval = SafetyObservationForm::where('status', 'PENDING_APPROVAL')
                    ->paginate(5, ['*'], 'pending_approval')
                    ->appends(request()->except('pending_approval'));
                $form_approved = SafetyObservationForm::where('status', 'APPROVED')
                    ->paginate(5, ['*'], 'approved')
                    ->appends(request()->except('approved'));
                $form_rejected = SafetyObservationForm::where('status', 'REJECTED')
                    ->paginate(5, ['*'], 'rejected')
                    ->appends(request()->except('rejected'));
                break;

            case ('safety representatif'):
                $companyId = $user->company->id;
                $form_pending_review = SafetyObservationForm::where('status', 'PENDING_REVIEW')
                    ->whereHas('createdBy', function ($query) use ($companyId) {
                        $query->where('company_id', $companyId);
                    })
                    ->paginate(5, ['*'], 'pending_review');
                $form_pending_approval = SafetyObservationForm::where('status', 'PENDING_APPROVAL')
                    ->whereHas('createdBy', function ($query) use ($companyId) {
                        $query->where('company_id', $companyId);
                    })
                    ->paginate(5, ['*'], 'pending_approval');
                $form_approved = SafetyObservationForm::where('status', 'APPROVED')
                    ->paginate(5, ['*'], 'form_approved');
                break;
                
            case ('safety officer'):
                $companyId = $user->company->id;
                $form_pending_review = SafetyObservationForm::where('status', 'PENDING_REVIEW')
                    ->whereHas('createdBy', function ($query) use ($companyId) {
                        $query->where('company_id', $companyId);
                    })
                    ->paginate(5, ['*'], 'pending_review');
                $form_pending_approval = SafetyObservationForm::where('status', 'PENDING_APPROVAL')
                    ->whereHas('createdBy', function ($query) use ($companyId) {
                        $query->where('company_id', $companyId);
                    })
                    ->paginate(5, ['*'], 'pending_approval');
                $form_approved = SafetyObservationForm::where('status', 'APPROVED')
                    ->paginate(5, ['*'], 'form_approved');
                break;

            case ('pegawai'):
                $form_pending_review = SafetyObservationForm::where('status', 'PENDING_REVIEW')
                    ->where('created_by', $user->id)
                    ->paginate(5, ['*'], 'pending_review');
                $form_pending_approval = SafetyObservationForm::where('status', 'PENDING_APPROVAL')
                    ->where('created_by', $user->id)
                    ->paginate(5, ['*'], 'pending_approval');
                $form_approved = SafetyObservationForm::where('status', 'APPROVED')
                    ->paginate(5, ['*'], 'form_approved');
                break;

            default:
                break;
        }

        return view('safety-observation-forms.safety-observation-form-index', compact('form_pending_review', 'form_pending_approval', 'form_approved', 'form_rejected'));
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
            // 'nomor_laporan' => 'required',
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
        // Ambil bulan dan tahun saat ini
        $now = Carbon::now();
        $month = $now->format('m');
        $year = $now->format('Y');

        // Ambil laporan terakhir dalam bulan tersebut
        $lastReport = SafetyObservationForm::whereMonth('created_at', '=', $month)
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
        $locationId = $request->input('location_id');
        $locationName = Location::find($locationId)->location;
        $abbreviation = '';

        $words = explode(" ", $locationName);

        foreach ($words as &$word) {
            preg_match_all('/[A-Z]/', $word, $matches);
            $abbreviation .= implode("", $matches[0]);
        }

        $abbreviation = str_pad($abbreviation, 5);

        // Buat string nomor laporan
        $nomorLaporanString = $nomorLaporan . '/' . 'SOF' . '/' . $abbreviation . '/' . $month . '/' . $year;

        $form = SafetyObservationForm::create([
            'nomor_laporan' => $nomorLaporanString,
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
    public function show(SafetyObservationForm $safety_observation_form)
    {
        return view('safety-observation-forms.safety-observation-form-show', compact('safety_observation_form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $form = SafetyObservationForm::findOrFail($id);

        // Check if the user is authorized to edit the form using the editForm policy
        if (Gate::allows('editForm', $form)) {
            $locations = Location::all();
            return view('safety-observation-forms.safety-observation-form-edit', compact('form', 'locations'));
        } else {
            // User is not authorized to edit the form
            // You can redirect them to a different page or show an error message
            return redirect()->route('safety-observation-forms.index')->with('error', 'You are not authorized to edit this form.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nomor_laporan' => 'required',
            'date_finding' => 'required',
            'location_id' => 'required',
            'safety_observation_type' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // TODO: fix this
            'description' => 'required',
            'hazard_potential' => 'required',
            'impact' => 'required',
            'short_term_recommendation' => 'required',
            'middle_term_recommendation' => 'required',
            'long_term_recommendation' => 'required',
            'completation_date' => 'required',
            'created_by' => 'required',
            'status' => 'required',
        ]);

        $form = SafetyObservationForm::findOrFail($id);
        $form->update($validatedData);

        Session::flash('message', 'Form updated successfully.');

        // return Redirect::route('safety-observation-forms.show', $form->id); TODO: integrate
        return Redirect::route('safety-observation-forms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Retrieve the form based on the provided ID
        $form = SafetyObservationForm::findOrFail($id);

        // Delete the form
        $form->delete();

        // Optionally, you can add a flash message to indicate the successful deletion
        Session::flash('message', 'Form deleted successfully.');

        // Redirect back to the index page or any other page as needed
        return redirect()->route('safety-observation-forms.index');
    }

    public function reviewByShe($id)
    {
        // Retrieve the form based on the provided ID
        $form = SafetyObservationForm::findOrFail($id);

        return view('safety-observation-forms.safety-observation-form-review', compact('form'));
    }

    public function updateReviewedByShe(Request $request, $id)
    {
        // Retrieve the form based on the provided ID
        $form = SafetyObservationForm::findOrFail($id);

        $action = $request->input('action');


        $reviewComment = null;
        $rejectionComment = null;
        if ($action === 'approve') {
            $finalStatus = 'PENDING_APPROVAL';
            $reviewComment = $request->input('review_comment') ?? 'NO COMMENT';
        } elseif ($action === 'reject') {
            $finalStatus = 'REJECTED';
            $rejectionComment = $request->input('reject_comment') ?? 'NO COMMENT';
        }

        $reviewedById = Auth::id();
        $form->update([
            'status' => $finalStatus,
            'review_comment' => $reviewComment,
            'reject_comment' => $rejectionComment,
            'reviewed_by' => $reviewedById
        ]);

        Session::flash('message', 'Form ' . ucfirst($action) . 'ed successfully.');
        return redirect()->route('safety-observation-forms.index');
    }

    // public function reviewSafetyObservation(SafetyObservationForm $forms)
    // {
    //     // Assuming you have authenticated the reviewer user.
    //     $reviewer = auth()->user();

    //     // Perform any checks to ensure the user is authorized to review the form.

    //     // For example, check user roles or permissions here.

    //     // Update the review status of the form to "Reviewed" (you can adjust this status according to your needs).
    //     $forms->status = 'Reviewed';
    //     $forms->save();

    //     // Associate the reviewer with the form.
    //     $forms->reviewer()->associate($reviewer);
    //     $forms->save();

    //     // Redirect back or perform any other action as needed.
    //     return redirect()->back()->with('success', 'Safety Observation Form reviewed successfully.');
    // }

    public function approveByManager($id)
    {
        $form = SafetyObservationForm::findOrFail($id);

        return view('safety-observation-forms.safety-observation-form-approve', compact('form'));
    }

    public function updateApprovedByManager(Request $request, $id)
    {
        $form = SafetyObservationForm::findOrFail($id);

        $action = $request->input('action');

        $approveComment = null;
        $rejectionComment = null;
        if ($action === 'approve') {
            $finalStatus = 'APPROVED';
            $approveComment = $request->input('approve_comment') ?? 'NO COMMENT';
        } elseif ($action === 'reject') {
            $finalStatus = 'REJECTED';
            $rejectionComment = $request->input('reject_comment') ?? 'NO COMMENT';
        }

        $approvedById = null;
        if ($action === 'approve') {
            $approvedById = Auth::id();
        }

        $form->update([
            'status' => $finalStatus,
            'approve_comment' => $approveComment,
            'reject_comment' => $rejectionComment,
            'approved_by' => $approvedById
        ]);

        Session::flash('message', 'Form ' . ucfirst($action) . 'ed successfully.');
        return redirect()->route('safety-observation-forms.index');
    }
}
