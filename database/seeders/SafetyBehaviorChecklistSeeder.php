<?php

namespace Database\Seeders;

use App\Models\SafetyBehaviorChecklist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SafetyBehaviorChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Operasi Pemindahan',
            'Penggalian',
            'Pekerjaan di Ketinggian',
            'Platform Kerja dan Akses',
            'Pekerjaan Manual',
            'Pekerjaan Panas',
            'Peralatan dan Mesin',
            'Pengelolaan Lalu Lintas',
            'Alat Pelindung Diri',
        ];

        $questions =[
            'operasi_pemindahan' => [
                'operasi_pemindahan_1' => 'Petugas pemberi isyarat memberikan isyarat peringatan pada saat beban diangkat atau dipindahkan.',
                'operasi_pemindahan_2' => 'Petugas pemberi isyarat memberikan isyarat jika tidak ada orang yang berdiri di bawah muatan yang ditangguhkan.',
                'operasi_pemindahan_3' => 'Crane diparkir pada pondasi yang kokoh.',
                'operasi_pemindahan_4' => 'Riggers menggunakan tag-line dengan benar untuk mengontrol beban.',
                'operasi_pemindahan_5' => 'Operator tidak mendorong atau tidak menyeret beban.',
                'operasi_pemindahan_6' => 'Terdapat Rigger/Signalman dan Lifting Supervisor selama operasi pengangkatan.'
            ],
            'penggalian' => [
                'penggalian_1' => 'Pekerja memasang barikade di sekitar area galian.',
                'penggalian_2' => 'Pekerja menggunakan rute keluar dan masuk dengan sesuai.',
                'penggalian_3' => 'Signalman mengarahkan pergerakan truk di area kerja.',
                'penggalian_4' => 'Pengawas mencegah pekerja tanpa izin berada di area kerja.',
                'penggalian_5' => 'Pekerja tidak berkepentingan tidak berada di area kerja.',
                'penggalian_6' => 'Pengawas melakukan komunikasi aktif dengan operator.',
                'penggalian_7' => 'Pengawas selalu ada dan mengawasi selama operator ekskavator bekerja.',
                'penggalian_8' => 'Operator mengoperasikan ekskavator yang memiliki izin jalan.'
            ],
            'pekerjaan_di_ketinggian' => [
                'pekerjaan_di_ketinggian_1' =>	'Pekerja tidak menggunakan tangga yang rusak.',
                'pekerjaan_di_ketinggian_2' =>	'Pekerja selalu menerapkan ”Three Point Contact” saat bekerja.',
                'pekerjaan_di_ketinggian_3' =>	'Pekerja tidak mengangkut atau menurunkan barang pada saat menaiki atau menuruni tangga.',
                'pekerjaan_di_ketinggian_4' =>	'Pekerja tidak melakukan pekerjaan di scaffolding yang tidak aman.',
                'pekerjaan_di_ketinggian_5' =>	'Pekerja selalu mengaitkan full body harness pada tempat yang tersedia pada saat bekerja.',
                'pekerjaan_di_ketinggian_6' =>	'Pekerja tidak mengenakan full body harness secara longgar.',
                'pekerjaan_di_ketinggian_7' =>	'Pekerja tidak memodifikasi scaffolding tanpa pengetahuan atau tanpa persetujuan supervisor scaffolding.',
                'pekerjaan_di_ketinggian_8' =>	'Pekerja tidak menjatuhkan barang dari ketinggian saat area di bawah belum diisolasi.',
                'pekerjaan_di_ketinggian_9' =>	'Pekerja tidak melakukan pekerjaan disaat terdapat aktifitas di bawah area kerja.'
            ],
            'platform_kerja_dan_akses' => [
                'platform_kerja_dan_akses1' =>	'Pekerja menggunakan platform yang bebas dari bahaya terpleset dan terjatuh.',
                'platform_kerja_dan_akses2' =>	'Pekerja menggunakan akses naik dan turun yang tidak terdapat hambatan.',
                'platform_kerja_dan_akses3' =>	'Pekerja berdiri di atas platform kerja yang aman dengan pijakan kaki yang memadai.'
            ],
            'pekerjaan_manual' => [
                'pekerjaan_manual_1'	=> 'Melakukan pekerjaan manual handling dengan jumlah pekerja yang memadai.',
                'pekerjaan_manual_2'	=> 'Pekerja melakukan pekerjaan manual handling dengan posisi yang benar.',
                'pekerjaan_manual_3'	=> 'Pekerja dengan jumlah lebih dari 2 orang telah berkomunikasi dengan baik dalam melakukan pekerjaan manual handling.'
            ],
            'pekerjaan_panas' => [
                'pekerjaan_panas_1' =>	'Melakukan pekerjaan manual handling dengan jumlah pekerja yang memadai.',
                'pekerjaan_panas_2' =>	'Pekerja melakukan pekerjaan manual handling dengan posisi yang benar.',
                'pekerjaan_panas_3' =>	'Pekerja dengan jumlah lebih dari 2 orang telah berkomunikasi dengan baik dalam melakukan pekerjaan manual handling.',
                'pekerjaan_panas_4' =>	'Melakukan pekerjaan manual handling dengan jumlah pekerja yang memadai.',
                'pekerjaan_panas_5' =>	'Pekerja melakukan pekerjaan manual handling dengan posisi yang benar.',
                'pekerjaan_panas_6' =>	'Pekerja dengan jumlah lebih dari 2 orang telah berkomunikasi dengan baik dalam melakukan pekerjaan manual handling.',
                'pekerjaan_panas_7' =>	'Melakukan pekerjaan manual handling dengan jumlah pekerja yang memadai.'
            ],
            'peralatan_dan_mesin' => [
                'peralatan_dan_mesin_1' =>	'Operator bekerja dengan menutup ruang mesin kemudi.',
                'peralatan_dan_mesin_2' =>	'Operator tidak menggunakan forklist, crane, dan truk untuk dijadikan pijakan dalam bekerja.',
                'peralatan_dan_mesin_3' =>	'Operator mematikan plnt/mesin jika terjadi maintenance.'
            ],
            'pengelolaan_lalu_lintas' => [
                'pengelolaan_lalu_lintas_1' =>	'Operator memundurkan alat dengan bantuan pihak kedua sebagai pemberi aba-aba.',
                'pengelolaan_lalu_lintas_2' =>	'Terdapat pemberi sinyal pada jalur akses vital pekerjaan.',
                'pengelolaan_lalu_lintas_3' =>	'Pekerja tidak berjalan pada blind spot pengemudi/operator.',
                'pengelolaan_lalu_lintas_4' =>	'Pekerja menyeberang dengan hati-hati.'
            ],
            'alat_pelindung_diri' => [
                'alat_pelindung_diri_1' =>	'Pekerja menggunakan alat pelindung kepala dengan baik.',
                'alat_pelindung_diri_2' =>	'Pekerja menggunakan alat pelindung kaki dengan baik.',
                'alat_pelindung_diri_3' =>	'Pekerja menggunakan alat pelindung pendengaran dengan baik.',
                'alat_pelindung_diri_4' =>	'Pekerja menggunakan alat pelindung mata dengan baik.',
                'alat_pelindung_diri_5' =>	'Pekerja menggunakan alat pelindung pernapasan dengan baik.',
                'alat_pelindung_diri_6' =>	'Pekerja menggunakan alat pelindung tangan dengan baik.',
                'alat_pelindung_diri_7' =>	'Pekerja menggunakan alat pelindung ketinggian dengan baik.'
            ],
        ];

        foreach ($categories as $category) {
            $string1 = str_replace(' ', '_', $category);
            $jsonData = [
                'category' => $category,
                'question'  => $questions[strtolower($string1)]
            ];

            $questionCount = count($jsonData['question']);

            SafetyBehaviorChecklist::create([
                'category' => $category,
                'question' => json_encode($jsonData),
                'question_count' => $questionCount,
            ]);
        }
    }
}
