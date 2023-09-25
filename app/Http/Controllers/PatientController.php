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

    public function store() {
      $data = request()->validate([
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'dob' => '',
        'health_insurance_number' => '', // depends on the country
        'phone' => '',
        'address' => '',
        'illness' => '',
        'allergies' => '',
      ]);

      auth()->user()->patients()->create($data);

      return back();
    }

}
