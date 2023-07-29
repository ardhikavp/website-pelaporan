<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::where('company', 'Politeknik Perkapalan Negeri Surabaya')->first();
        if ($company) {
            User::create([
                'name' => 'pegawai',
                'username' => 'pegawai',
                'email' => 'pegawai@example.com',
                'password' => Hash::make('password'),
                'role' => 'pegawai',
                'company_id' => $company->id,
            ]);
        }

        $company = Company::where('company', 'PT Petro Jordan Abadi')->first();
        if ($company) {
            User::create([
                'name' => 'Ayu Puspa Arum',
                'username' => 'pegawai2',
                'email' => 'pegawai2@example.com',
                'password' => Hash::make('password'),
                'role' => 'pegawai',
                'company_id' => $company->id,
            ]);
        }
    }
}
