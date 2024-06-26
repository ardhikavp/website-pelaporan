<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\SafetyObservationForm;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\NeedReviewDocument;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewApprovedSafetyObservation;
use App\Notifications\NewNeedReviewSafetyObservation;
use App\Notifications\NewNeedApproveSafetyObservation;

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
                $form_rejected = SafetyObservationForm::where('status', 'REJECTED')
                    ->where('created_by', $user->id)
                    ->paginate(5, ['*'], 'rejected')
                    ->appends(request()->except('rejected'));
                break;

            default:
               break;
        }

        return view('safety-observation-forms.safety-observation-form-index', compact('form_pending_review', 'form_pending_approval', 'form_approved', 'form_rejected'));
    }

    public function myInput()
    {
        $user = Auth::user();

        $form_pending_review = [];
        $form_pending_approval = [];
        $form_approved = [];
        $form_rejected = [];


        switch ($user->role) {
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
                $form_rejected = SafetyObservationForm::where('status', 'REJECTED')
                    ->where('created_by', $user->id)
                    ->paginate(5, ['*'], 'rejected')
                    ->appends(request()->except('rejected'));
                break;

            default:
                break;
        }
        return view('safety-observation-forms.safety-observation-form-my-report', compact('form_pending_review', 'form_pending_approval', 'form_approved', 'form_rejected'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $images = Image::all();
        $locations = Location::all();
        $users = User::all();
        return view('safety-observation-forms.approval.safety-observation-form-create', compact('locations', 'users', 'images'));
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
        $lastReport = SafetyObservationForm::whereMonth('date_finding', '=', $month)
            ->whereYear('date_finding', '=', $year)
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

        $userToNotify = User::where('role', 'SHE')->get();

        Notification::send($userToNotify, new NewNeedReviewSafetyObservation($form));

        Session::flash('message', 'Form created successfully.');

        return Redirect::route('safety-observation-forms.index', $form->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(SafetyObservationForm $safety_observation_form)
    {
        return view('safety-observation-forms.approval.safety-observation-form-show', compact('safety_observation_form'));
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
            return view('safety-observation-forms.approval.safety-observation-form-edit', compact('form', 'locations'));
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

        return view('safety-observation-forms.approval.safety-observation-form-review', compact('form'));
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

        $userToNotify = User::where('role', 'manager maintenance')->get();

        Notification::send($userToNotify, new NewNeedApproveSafetyObservation($form));

        Session::flash('message', 'Form ' . ucfirst($action) . 'ed successfully.');
        return redirect()->route('safety-observation-forms.index');
    }

    public function approveByManager($id)
    {
        $form = SafetyObservationForm::findOrFail($id);

        return view('safety-observation-forms.approval.safety-observation-form-approve', compact('form'));
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

        // Get the user IDs of creators of safety observation forms
        $creatorUserIds = SafetyObservationForm::pluck('created_by');

        // Get the user IDs of users with roles 'SHE' and 'admin'
        $sheAndAdminUserIds = User::whereIn('role', ['SHE', 'admin'])->pluck('id');

        // Combine the user IDs of creators, SHE, and admin users
        $userIdsToNotify = $creatorUserIds->concat($sheAndAdminUserIds);

        // Remove duplicate user IDs
        $userIdsToNotify = $userIdsToNotify->unique();

        // Get the actual User objects to notify
        $usersToNotify = User::whereIn('id', $userIdsToNotify)->get();

        // Send notifications to the users
        Notification::send($usersToNotify, new NewApprovedSafetyObservation($form));


        Session::flash('message', 'Form ' . ucfirst($action) . 'ed successfully.');
        return redirect()->route('safety-observation-forms.index');
    }

    public function getPaginatedData(Request $request)
    {
        $perPage = 10; // Number of items per page
        $data = SafetyObservationForm::paginate($perPage);

        return new JsonResponse($data);
    }

    public function historyPages(Company $companies)
    {
        $companies = Company::all();

        $approvedFormsCounts = DB::table('users')
            ->join('companies', 'users.company_id', '=', 'companies.id')
            ->join('safety_observation_forms', 'users.id', '=', 'safety_observation_forms.created_by')
            ->where('safety_observation_forms.status', 'APPROVED')
            ->select('companies.company', 'users.name', DB::raw('COUNT(*) as approved_forms_count'))
            ->groupBy('companies.company', 'users.name')
            ->get();

        $totalApprovedForms = $approvedFormsCounts
        ->groupBy('company')
        ->map(function ($group) {
            return $group->sum('approved_forms_count');
        });

        $tahun_yang_diinginkan = 2023;

        // Query to get the data based on the desired year
        $data = SafetyObservationForm::select(
            DB::raw('YEAR(created_at) AS tahun'),
            DB::raw('MONTH(created_at) AS bulan'),
            DB::raw('SUM(CASE WHEN status = "APPROVED" THEN 1 ELSE 0 END) AS jumlah_approved'),
            DB::raw('SUM(CASE WHEN status = "REJECTED" THEN 1 ELSE 0 END) AS jumlah_rejected'),
            DB::raw('SUM(CASE WHEN status = "PENDING_REVIEW" THEN 1 ELSE 0 END) AS jumlah_pending_review'),
            DB::raw('SUM(CASE WHEN status = "PENDING_APPROVAL" THEN 1 ELSE 0 END) AS jumlah_pending_approval')
        )
            ->whereYear('created_at', $tahun_yang_diinginkan) // Filter by the desired year
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderByRaw('YEAR(created_at), MONTH(created_at)')
            ->get();

        // Calculate the result of the performance measurement and add it to the data object
        foreach ($data as $item) {
            $total_laporan = $item->jumlah_approved + $item->jumlah_rejected + $item->jumlah_pending_review + $item->jumlah_pending_approval;
            $item->hasil_perhitungan = ($total_laporan !== 0) ? number_format((($item->jumlah_approved + $item->jumlah_rejected) / $total_laporan) * 100, 2) : 0;
        }

        return view('histories.history-so', compact('companies', 'approvedFormsCounts' ,'totalApprovedForms', 'data'));
    }

    public function finishSafetyObsevationForm()
    {
        $forms = SafetyObservationForm::all();

        return view('finish_report.finish-report-index', compact('forms'));
    }

    public function finishingSafetyObsevationForm($id)
    {
        $form = SafetyObservationForm::findOrFail($id);

        return view('finish_report.finish-report-closed', compact('form'));
    }

    public function finalUpdateSafetyObservationForms(Request $request, $id)
    {
        $form = SafetyObservationForm::findOrFail($id);

        $action = $request->input('action');

        if ($request->hasFile('pdf_file')) {
            // Handle file upload and update finish_report_path
            $pdfFile = $request->file('pdf_file');
            $pdfFilePath = $pdfFile->store('finish_reports', 'public');
            $form->finish_report_path = $pdfFilePath;
            $form->finish_report = 'CLOSED';
            $form->save();
        }

        Session::flash('message', 'Form Uploaded successfully.');
        return redirect()->route('progress.so');
    }

    public function downloadReport($filename)
    {
        $filePath = 'finish_reports/' . $filename;

        if (Storage::disk('public')->exists($filePath)) {
            return response()->download(storage_path('app/public/' . $filePath));
        } else {
            return abort(404); // File not found
        }
    }

    public function showFinishSafetyObsevationForm($id)
    {
        $form = SafetyObservationForm::findOrFail($id);

        return view('finish_report.finish-report-show', compact('form'));
    }
}
