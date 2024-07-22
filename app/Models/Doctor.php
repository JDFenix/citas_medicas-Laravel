<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'paternal_surname',
        'maternal_surname',
    ];

   
    public function appointments()
    {
        return $this->belongsTo(Appointment::class, 'doctor_id');
    }

  
    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
}