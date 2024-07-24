<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::factory()->create([
            'avatar' => 'https://api.dicebear.com/9.x/open-peeps/svg?seed=' . bcrypt('JDFENIX'),
            'role' => 'admin',
            'name' => 'Oscar',
            'maternal_surname' => 'Mata',
            'paternal_surname' => 'Alegria',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456789'),
        ]);


        $user = User::factory()->create([
            'avatar' => 'https://api.dicebear.com/9.x/open-peeps/svg?seed=' . bcrypt('IsmaelMoralesBarrios'),
            'role' => 'pacient',
            'name' => 'Ismael',
            'maternal_surname' => 'Morales',
            'paternal_surname' => 'Barrios',
            'email' => 'test@example.com',
            'password' => bcrypt('123456789'),
        ]);

        $clinic = Clinic::create([
            'speciality' => 'Cardiologia',
            'consultory' => '1'
        ]);

        $doctor = Doctor::create([
            'name' => 'Anghel Raul',
            'paternal_surname' => 'Sandoval',
            'maternal_surname' => 'Martinez',
            'clinics_id' => $clinic->id
        ]);


        Appointment::create([
            'date' => now(),
            'hour' => Carbon::createFromTime(14, 30, 0),
            'users_id' => $user->id,
            'clinics_id' => $clinic->id,
            'doctors_id' => $doctor->id
        ]);
    }
}
