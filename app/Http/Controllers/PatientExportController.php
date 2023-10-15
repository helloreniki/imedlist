<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PatientExportController extends Controller
{
    public function __invoke(Patient $patient) {
      $drugs = $patient->drugs()->get();
      // dd($drugs);

      $pdf = Pdf::loadView('pdf-list', [
        'patient' => $patient,
        'drugs' => $drugs,
      ]);
      return $pdf->stream();
    }
}
