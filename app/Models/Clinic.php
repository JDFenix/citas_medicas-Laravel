<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{

    protected $fillable = [
        'speciality',
        'consultory'

    ];

    use HasFactory;

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
}
