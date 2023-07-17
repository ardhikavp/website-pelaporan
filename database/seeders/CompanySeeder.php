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
            'CV. Trikarya Abadi',
            'PT. Putra Baru Sentosa',
            'CV. BLM',
            'PT Primakarya jaya Sejahtera',
            'CV. Anugrah Energi Gresik',
            'PT. Petrokopindo Cipta Selaras',
            'K3PG',
            'PT. Sinar Abadi Indah',
            'CV. Tri Sukses Mulia',
            'CV. Sumber Rejeki',
            'Koperasi Tunas Harapan',
            'CV. Barokah Utama',
            'CV. Ladju Berkah',
            'PT. Fokus Jasa Mitra',
            'PT. Multikarya Mandiri Sejahtera',
            'Karyawan PJA PA',
            'Karyawan PJA Mekanik',
            'PT MJB',
            'PT Trust Sarana Persada',
            'Karyawan PJA',
            'PT. Fano Prima Jaya',
            'PT PMMK',
            'CV. PJA',
            'Koperasi Jasa Pemuda Gangsar',
            'PT DMR',
            'PT. BHS',
            'PT. Sohib Jaya Putra',
            'PT Multiguna Globalindo',
            'PT. Media Teknika',
            'PT Wahana Kerta Kencana',
            'PT. Wildan Jaya Abadi',
            'PT. ANJP',
            'PT. AJNP',
            'PT. MJB'
        ];

        foreach ($companies as $company) {
            Company::create(['company' => $company]);
        }
    }
}
