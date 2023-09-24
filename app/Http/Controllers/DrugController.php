<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DrugController extends Controller
{
    public function store(Request $request, Patient $patient) {
      // dd($patient);
      $units = Drug::UNITS;

      $data = $request->validate([
        'name' => 'required',
        'concentration' => 'required|max:8',
        'active_ingredient' => 'min:3',
        'dosage_custom' => '',
        'dosage_morning' => '',
        'dosage_midday' => '',
        'dosage_evening' => '',
        'unit' => [Rule::in($units)]
      ]);
      $patient->drugs()->create($data);

      return back();
    }
}
