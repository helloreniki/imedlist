<?php

namespace App\Models;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Drug extends Model
{
    use HasFactory;

    const UNITS = ['tablet', 'capsule', 'ml', 'drop'];
    protected $fillable = ['name', 'concentration', 'active_ingredient', 'dosage_custom', 'dosage_morning', 'dosage_midday', 'dosage_evening', 'unit', 'patient_id'];

    public function patient() {
      return $this->belongsTo(Patient::class);
    }
}
