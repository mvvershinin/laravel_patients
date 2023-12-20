<?php

namespace App\Services\Patients;

use App\Http\Resources\PatientsIndexResource;
use App\Repositories\PatientRepository;
use App\Services\Patients\Dto\PatientDto;
use Illuminate\Support\Facades\Log;

class PatientService
{
    const CREATE_FAIL_CODE = 500;
    const CUSTOM_CODE = 404;

    public function __construct(
        protected PatientRepository $patientRepository,
        protected PatientJobService $patientJobService,
        protected PatientCacheService $patientCacheService
    )
    {
    }

    public function storePatient(PatientDto $patientDto): object
    {
        try {
            $patient = $this->patientRepository->store($patientDto);
            $this->patientCacheService->putPatient($patient);
            $this->patientJobService->runDefaultJob($patient->id);

            return (object)['success' => true];
        } catch (\Throwable $exception) {
            //todo log exception
            Log::error('save error');
            //todo custom exception code if need it
            return (object)[
                'success' => false,
                'code' => self::CREATE_FAIL_CODE,
            ];
        }
    }

    public function getList(int $offset, int $limit): object
    {
        try {
            $patients = $this->patientCacheService->getList([$this->patientRepository, 'index'], $offset, $limit);
            return (object)[
                'data' => PatientsIndexResource::collection($patients),
                'success' => true
            ];
        } catch (\Throwable $exception) {
            //todo log exception
            Log::error('get list error');
            //todo custom exception code if need it
            return (object)[
                'success' => false,
                'code' => self::CUSTOM_CODE,
            ];
        }

    }
}
