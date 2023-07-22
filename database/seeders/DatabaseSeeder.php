<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SafetyObservationForm;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            CompanySeeder::class,
        ]);

        $this->call([
            LocationSeeder::class,
        ]);

        $this->call([
            SafetyBehaviorChecklistSeeder::class,
        ]);

        $this->call([
            AdminSeeder::class,
        ]);

        $this->call([
            SHESeeder::class,
        ]);
        $this->call([
            SafetyOfficerSeeder::class,
        ]);
        $this->call([
            ManagerSeeder::class,
        ]);
        $this->call([
            PegawaiSeeder::class,
        ]);
        $this->call([
            SafetyRepresentatifSeeder::class,
        ]);

        SafetyObservationForm::factory(30)->create();
    }
}
