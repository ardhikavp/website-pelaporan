<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::where('company', 'PT Petro Jordan Abadi')->first();
        if ($company) {
            User::create([
                'name' => 'Manager',
                'username' => 'manager',
                'email' => 'manager@example.com',
                'password' => Hash::make('password'),
                'role' => 'manager maintenance',
                'company_id' => $company->id,
                'status' => 'APPROVED',
            ]);
        }
    }
}
