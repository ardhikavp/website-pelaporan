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
            'PPNS',
            'PT Petro Jordan Abadi',
            'CV. Trikarya Abadi',
            'PT. Putra Baru Sentosa',
            'PT Primakarya jaya Sejahtera',
            'CV. Anugrah Energi Gresik',
            'PT. Petrokopindo Cipta Selaras',
            'K3PG',
            'PT. Sinar Abadi Indah',
            'CV. Tri Sukses Mulia',
            'CV. Sumber Rejeki',
            'CV. Barokah Utama',
            'CV. Ladju Berkah',
            'PT. Fokus Jasa Mitra',
            'PT. Multikarya Mandiri Sejahtera',
            'PT Trust Sarana Persada',
            'PT. Koperasi Jasa Pemuda Gangsar',
            'PT. Sohib Jaya Putra',
            'PT. Multiguna Globalindo',
            'PT. Media Teknika',
            'PT. Wahana Kerta Kencana',
            'PT. Wildan Jaya Abadi',
        ];

        foreach ($companies as $company) {
            Company::create(['company' => $company]);
        }
    }
}
