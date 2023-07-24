<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Image;
use Faker\Generator as Faker;
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
    protected $model = SafetyObservationForm::class;

    protected static $lastNumber = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = $this->faker->unique($maxRetries = 20000);

        $locationIds = Location::pluck('id')->all();
        $imageIds = Image::pluck('id')->all();
        $pegawaiUsers = User::where('role', 'pegawai')->pluck('id')->all();

        $now = Carbon::now();
        $month = $now->format('m');
        $year = $now->format('Y');

        // $lastReport = SafetyObservationForm::whereMonth('created_at', '=', $month)
        //     ->whereYear('created_at', '=', $year)
        //     ->orderByDesc('id')
        //     ->first();
                // Ambil bulan dan tahun saat ini
        if (self::$lastNumber >= 50) {
            throw new \OverflowException('Maximum number of instances reached.');
        }

        // Increment the lastNumber by 1 for the current instance
        self::$lastNumber++;

        $nomorLaporan = str_pad(self::$lastNumber, 3, '0', STR_PAD_LEFT);
        // Ambil singkatan perusahaan dari input
        $locationId = $faker->randomElement($locationIds);
        $locationName = Location::find($locationId)->location;
        $abbreviation = '';

        $words = explode(" ", $locationName);

        foreach ($words as &$word) {
            preg_match_all('/[A-Z]/', $word, $matches);
            $abbreviation .= implode("", $matches[0]);
        }

        $abbreviation = str_pad($abbreviation, 5);

        // Buat string nomor laporan
        $nomorLaporanString = $nomorLaporan . '/' . 'SOV' . '/' . $abbreviation . '/' . $month . '/' . $year;

        return [
            'nomor_laporan' => $nomorLaporanString,
            'date_finding' => $faker->date(),
            'location_id' => $faker->randomElement($locationIds),
            'safety_observation_type' => $faker->randomElement(['unsafe_action', 'unsafe_condition', 'bad_housekeeping']),
            'image_id' => $faker->randomElement($imageIds),
            'description' => $faker->paragraph,
            'hazard_potential' => $faker->paragraph,
            'impact' => $faker->paragraph,
            'short_term_recommendation' => $faker->paragraph,
            'middle_term_recommendation' => $faker->paragraph,
            'long_term_recommendation' => $faker->paragraph,
            'completation_date' => $faker->date(),
            'created_by' => $faker->randomElement($pegawaiUsers),
            'reviewed_by' => null,
            'approved_by' => null,
            'status' => $faker->randomElement(['PENDING_REVIEW']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
