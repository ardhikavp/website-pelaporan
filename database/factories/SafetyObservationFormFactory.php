<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Image;

use App\Models\Location;
use Illuminate\Support\Carbon;
use Illuminate\Http\UploadedFile;
use App\Models\SafetyObservationForm;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SafetyObservationForm>
 */
class SafetyObservationFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $locationIds = Location::pluck('id')->all();
        $imageIds = Image::pluck('id')->all();
        $pegawaiUsers = User::where('role', 'pegawai')->pluck('id')->all();

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
        $locationId = $this->faker->randomElement($locationIds);
        $locationName = Location::find($locationId)->location;
        $abbreviation = '';

        $words = explode(" ", $locationName);

        foreach ($words as &$word) {
            preg_match_all('/[A-Z]/', $word, $matches);
            $abbreviation .= implode("", $matches[0]);
        }

        $abbreviation = str_pad($abbreviation, 5);

        // Buat string nomor laporan
        $nomorLaporanString = $nomorLaporan . '/' . 'SBC' . '/' . $abbreviation . '/' . $month . '/' . $year;

        return [
            'nomor_laporan' => $nomorLaporanString,
            'date_finding' => $this->faker->date(),
            'location_id' => $this->faker->randomElement($locationIds),
            'safety_observation_type' => $this->faker->randomElement(['unsafe_action', 'unsafe_condition', 'bad_housekeeping']),
            'image_id' => $this->faker->randomElement($imageIds),
            'description' => $this->faker->paragraph,
            'hazard_potential' => $this->faker->paragraph,
            'impact' => $this->faker->paragraph,
            'short_term_recommendation' => $this->faker->paragraph,
            'middle_term_recommendation' => $this->faker->paragraph,
            'long_term_recommendation' => $this->faker->paragraph,
            'completation_date' => $this->faker->date(),
            'created_by' => $this->faker->randomElement($pegawaiUsers),
            'reviewed_by' => null,
            'approved_by' => null,
            'status' => $this->faker->randomElement(['PENDING_REVIEW']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
