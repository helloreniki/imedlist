<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
      $patients = auth()->user()->patients()->with('drugs')->get();

      return inertia('Dashboard', [
        'patients' => $patients
      ]);
    }
}
