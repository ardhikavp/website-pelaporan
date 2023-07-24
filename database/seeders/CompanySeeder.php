<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            'Politeknik Perkapalan Negeri Surabaya',
            'PT Petro Jordan Abadi',
        ];

        foreach ($companies as $company) {
            Company::create(['company' => $company]);
        }
    }
}
