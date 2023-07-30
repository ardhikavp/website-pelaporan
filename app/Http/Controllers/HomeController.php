<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SafetyObservationForm;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $types_so = SafetyObservationForm::where('status', 'APPROVED')
            ->groupBy('safety_observation_type')
            ->selectRaw('safety_observation_type, COUNT(*) as total')
            ->get();

        $colors = ['#0074D9', '#7FDBFF', '#AAAAAA']; // Dark blue, light blue, and grey blue colors

        $chartData = $types_so->map(function ($item, $index) use ($colors) {
            return [
                'label' => $item->safety_observation_type,
                'data' => $item->total,
                'backgroundColor' => $colors[$index % count($colors)],
            ];
        });

        if ($chartData->isEmpty()) {
            $chartData->push([
                'label' => 'No Data',
                'data' => 0,
                'backgroundColor' => '#CCCCCC', // Use a default color for 'No Data'
            ]);
        }

        // Count the number of companies
        $totalCompanies = Company::count();

        // You can also get the location names along with the counts if needed
        $safetyObservationsPerLocation = Location::leftJoin('safety_observation_forms', 'locations.id', '=', 'safety_observation_forms.location_id')
            ->select('locations.location', DB::raw('COUNT(safety_observation_forms.id) as total'))
            ->where('status', '=', 'APPROVED')
            ->groupBy('locations.location')
            ->get();


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

        // dd($safetyObservationsPerLocation);


        return view('home', compact('chartData', 'totalCompanies', 'safetyObservationsPerLocation', 'data'));
    }
}
