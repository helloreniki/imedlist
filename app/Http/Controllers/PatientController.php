<?php

namespace App\Http\Controllers;

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

    public function show(Patient $patient){

      // eager load drugs
      $patient->load('drugs');

      return inertia('PatientShow', [
        'patient' => $patient
      ]);
    }
}
