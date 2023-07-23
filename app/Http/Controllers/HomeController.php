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

        // Count the number of safety observations in each location
        // $safetyObservationsPerLocation = SafetyObservationForm::select('location_id')
        //     ->selectRaw('COUNT(*) as total')
        //     ->groupBy('location_id')
        //     ->get();

        // You can also get the location names along with the counts if needed
        $safetyObservationsPerLocation = Location::leftJoin('safety_observation_forms', 'locations.id', '=', 'safety_observation_forms.location_id')
            ->select('locations.location', DB::raw('COUNT(safety_observation_forms.id) as total'))
            ->groupBy('locations.location')
            ->get();

        return view('home', compact('chartData', 'totalCompanies', 'safetyObservationsPerLocation'));
    }
}
