<?php


namespace App\Repositories;


use App\Models\Patient;
use App\Services\Patients\Dto\PatientDto;
use Illuminate\Database\Eloquent\Collection;

class PatientRepository
{
    public function store(PatientDto $patientDto): Patient
    {
        $patient = new Patient();
        $patient->first_name = $patientDto->first_name;
        $patient->last_name = $patientDto->last_name;
        $patient->birthdate = $patientDto->birthdate;
        $patient->age_type = $patientDto->age_type;
        $patient->age = $patientDto->age;
        //dd($patient->toArray());
        $patient->save();

        return $patient;
    }

    public function index(int $offset = 0, int $limit = 100): Collection
    {
        return  Patient::skip($offset)->take($limit)->get();
    }
}
