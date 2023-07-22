<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        return view('home', compact('chartData'));
    }
}
