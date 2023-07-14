<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            'Sulfuric Acid Plant',
            'Phosporic Acid Plant',
            'Granule Gypsum Plant',
            'Coal Storage',
            'Purifite Gypsum Sotrage',
            'Main Office',
            'Waste Water Treatment',
            'Control Room PA',
            'Control Room SA',
            'Control Room Demineral Water',
            'Tempat Penyimpanan Sementara LB3',
            'Gudang',
            'Bengkel Rotatik',
            'Bengkel Statik',
            'Disposal',
            'Storage Tank'
        ];

        foreach ($locations as $location) {
            Location::create(['location' => $location]);
        }
    }
}
