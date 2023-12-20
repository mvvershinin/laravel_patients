<?php


namespace App\Services\Patients;


use App\Jobs\PatientDefaultJob;

class PatientJobService
{
    public function runDefaultJob(int $patientId): void
    {
        PatientDefaultJob::dispatch($patientId);
    }
}
