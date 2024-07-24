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
        'clinics_id',
    ];

   
    public function appointments()
    {
        return $this->belongsTo(Appointment::class, 'doctor_id');
    }

  
    public function clinics()
    {
        return $this->belongsTo(Clinic::class, 'clinics_id');
    }
}