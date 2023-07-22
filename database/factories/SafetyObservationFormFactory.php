<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Image;

use App\Models\Location;
use Illuminate\Http\UploadedFile;
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

        return [
            'nomor_laporan' => $this->faker->unique()->word,
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
