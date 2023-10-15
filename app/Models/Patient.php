<?php

namespace App\Models;

use App\Models\Drug;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
      'first_name',
      'last_name',
      'dob',
      'health_insurance_number',
      'address',
      'phone',
      'illness',
      'allergies',
      'emergency_contact',
      'user_id'
    ];

    protected $casts = [
      'dob' => 'datetime'
    ];


    public function user() {
      return $this->belongsTo(User::class);
    }

    public function drugs() {
      return $this->hasMany(Drug::class);
    }
}
