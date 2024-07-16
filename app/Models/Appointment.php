<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'date',
        'users_id',
        'clinics_id',
        'doctors_id'
    ];

    use HasFactory;

    public function clinics()
    {
        return $this->belongsTo(Clinic::class, 'clinics_id');
    }

    public function doctors()
    {
        return $this->belongsTo(Doctor::class, 'doctors_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
