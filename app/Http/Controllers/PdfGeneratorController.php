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
            'deskripsi_gambar' => $form->description,
            'potensi_bahaya' => $form->hazard_potential,
            'dampak' => $form->impact,
            'jangka_pendek' => $form->short_term_recommendation,
            'jangka_menengah' => $form->middle_term_recommendation,
            'jangka_panjang' => $form->long_term_recommendation,
            'komentar' => $form->approved_comment ?? 'NO COMMENT',
            'tanggal_penyelesaian' => $form->completation_date,
            'image_path' => $form->image->image,
            'reviewed_by' => $form->reviewedBy->name,
            'reviewer_role' => $form->reviewedBy->role,
            'created_by' => $form->createdBy->name,
            'creator_role' => $form->createdBy->role,
            'approved_by' => $form->approvedBy->name,
            'approver_role' => $form->approvedBy->role
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
