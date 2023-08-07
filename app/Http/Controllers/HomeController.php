<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

        // dd($safetyObservationsPerLocation);


        //Unsafe Condition Grafik
        $dataLineGraphSO = DB::table('safety_observation_forms')
        ->select(
            DB::raw('DATE_FORMAT(date_finding, "%Y-%m") as month'),
            DB::raw('SUM(CASE WHEN safety_observation_type = "unsafe_action" THEN 1 ELSE 0 END) as unsafe_action_total'),
            DB::raw('SUM(CASE WHEN safety_observation_type = "unsafe_condition" THEN 1 ELSE 0 END) as unsafe_condition_total'),
            DB::raw('SUM(CASE WHEN safety_observation_type = "bad_housekeeping" THEN 1 ELSE 0 END) as bad_housekeeping_total')
        )
        ->where('status', 'APPROVED')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $labelsLG = [];
        $unsafeActionData = [];
        $unsafeConditionData = [];
        $badHousekeepingData = [];

        $bulanNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $formattedMonth = sprintf('2023-%02d', $bulan);
            $labelsLG[] = $bulanNames[$bulan] . '-2023';

            $item = $dataLineGraphSO->firstWhere('month', $formattedMonth);

            if ($item) {
                $unsafeActionData[] = $item->unsafe_action_total;
                $unsafeConditionData[] = $item->unsafe_condition_total;
                $badHousekeepingData[] = $item->bad_housekeeping_total;
            } else {
                $unsafeActionData[] = 0;
                $unsafeConditionData[] = 0;
                $badHousekeepingData[] = 0;
            }
        }

        $configLineGraph = [
            'type' => 'line',
            'data' => [
                'labels' => $labelsLG,
                'datasets' => [
                    [
                        'label' => 'Unsafe Action',
                        'data' => $unsafeActionData,
                        'fill' => false,
                        'borderColor' => 'rgb(255, 99, 132)',
                        'tension' => 0.1,
                    ],
                    [
                        'label' => 'Unsafe Condition',
                        'data' => $unsafeConditionData,
                        'fill' => false,
                        'borderColor' => 'rgb(75, 192, 192)',
                        'tension' => 0.1,
                    ],
                    [
                        'label' => 'Bad Housekeeping',
                        'data' => $badHousekeepingData,
                        'fill' => false,
                        'borderColor' => 'rgb(54, 162, 235)',
                        'tension' => 0.1,
                    ],
                ],
            ],
        ];
        //End UC Grafik

        return view('home', compact('chartData', 'totalCompanies', 'safetyObservationsPerLocation', 'configLineGraph'));
    }
}
