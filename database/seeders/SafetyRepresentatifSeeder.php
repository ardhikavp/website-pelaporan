<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SafetyRepresentatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::where('company', 'PPNS')->first();
            if ($company) {
                User::create([
                    'name' => 'safety representatif',
                    'username' => 'safetyrepresentatif',
                    'email' => 'safetyrepresentatif@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'safety representatif',
                    'company_id' => $company->id,
                    'status' => 'APPROVED',
                ]);
            }
    }
}
