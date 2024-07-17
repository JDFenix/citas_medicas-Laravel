<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

    protected $fillable = [
        'name',
        'paternal_surname',
        'maternal_surname',
    ];


    use HasFactory;




    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
