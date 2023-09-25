<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index() {
      $patients = auth()->user()->patients()->with('drugs')->get();

      return inertia('Dashboard', [
        'patients' => $patients
      ]);
    }

    // show pacient (with his drugs)
    public function show(Patient $patient){

      // eager load drugs
      $patient->load('drugs');
      $units = Drug::UNITS;
      // dd($units);

      return inertia('Patient/PatientShow', [
        'patient' => $patient,
        'units' => $units
      ]);
    }

}
