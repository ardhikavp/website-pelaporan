<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\SafetyObservationForm;
use Barryvdh\DomPDF\PDF;

class PdfGeneratorController extends Controller
{
    public function downloadSafetyObservation(PDF $pdf, $id)
    {
        $form = SafetyObservationForm::findOrFail($id);

        $data = [
            'nomor_laporan' => $form->nomor_laporan,
            'tanggal_temuan' => $form->date_finding,
            'lokasi_temuan' => $form->location->location,
            'tipe_temuan' => $form->safety_observation_type,
            'gambar_temuan' => 'gambar_temuan',
            'deskripsi_gambar' => $form->description,
            'potensi_bahaya' => $form->hazard_potential,
            'dampak' => $form->impact,
            'jangka_pendek' => $form->short_term_recommendation,
            'jangka_menengah' => $form->middle_term_recommendation,
            'jangka_panjang' => $form->long_term_recommendation,
            'komentar' => 'testaksjdasdashdkjahsdkjahskjdhakjshdkja shdhasdhaksdhakjshdkasjhdkashdkashdkjashdkahsdkhaskjdhakshdkashdahsk dhaskdhajkshdkashdkahskdashdjhaskjdhaskjdhkahsd akjdslkajskljd asdkajls djakldsj aj sdlkajsd lkajs dlajsd laksjd lkajsdlk asjd klajdlkas jdlkasj dlkasj dlkajsd lkasjdla skdjlaks jdlkasjd lkajs dlkajsd lkajskdlj aslkdj alksjd alksjd lakjsd laksjd alkjdlaksjd lkja akjd klasjdkla sjdaklj dlaksjd lasjd  aksljd alskjdl asdjk',
            'tanggal_penyelesaian' => '21 juni 22323'
        ];

        $pdf = $pdf->loadView('laporan-pdf.laporan', $data);
        return $pdf->download('itsolutionstuff.pdf');
    }

    public function downloadSafetyBehavior(PDF $pdf, $id)
    {
        $answer = Answer::findOrFail($id);

        $data = [
            "nomor_laporan" => $answer->nomor_laporan,
            "tanggal_temuan" => $answer->date_finding,
            "pekerjaan" => $answer->operation_name,
            "perusahaan" => $answer->company->company,
            "answer" => $answer->answer,
            "approved_by" => $answer->approvedBy->name,
            "created_by" => $answer->user->name,
            "komentar" => $answer->approve_comment
        ];
        $dataobj = (object)$data;

        // return view('laporan-pdf.safety-behavior-checklist-report', compact('dataobj'));
        $pdf = $pdf->loadView('laporan-pdf.safety-behavior-checklist-report', $data);
        return $pdf->download('itsolutionstuff.pdf');
    }
}
