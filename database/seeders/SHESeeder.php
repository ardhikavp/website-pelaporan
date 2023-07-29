<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SHESeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::where('company', 'PT Petro Jordan Abadi')->first();
            if ($company) {
                User::create([
                    'name' => 'SHE',
                    'username' => 'SHE',
                    'email' => 'SHE@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'SHE',
                    'company_id' => $company->id,
                ]);

                User::create([
                    'name' => 'Ardhika Vira Pramudya',
                    'username' => 'SHE2',
                    'email' => 'SHE2@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'SHE',
                    'company_id' => $company->id,
                ]);
            }
    }
}
