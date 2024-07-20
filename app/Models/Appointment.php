<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'hour',
        'users_id',
        'clinics_id',
        'doctors_id'
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinics_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctors_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
