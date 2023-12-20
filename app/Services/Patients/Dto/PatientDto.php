<?php


namespace App\Services\Patients\Dto;


use Carbon\Carbon;

class PatientDto
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public Carbon $birthdate,
        public string $age_type,
        public int $age,
    ){
    }
}
