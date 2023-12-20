<?php

namespace App\Http\Controllers\v1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientsIndexRequest;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Resources\PatientsIndexResource;
use App\Models\Patient;
use App\Services\Patients\PatientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{
    public function __construct(
        protected PatientService $patientService
    ) {
    }

    public function store(PatientStoreRequest $request): JsonResponse
    {
        $result = $this->patientService->storePatient($request->getPatientDto());

        return new JsonResponse(
            $result,
            $result->success ? Response::HTTP_CREATED : $result->code
        );
    }

    public function index(PatientsIndexRequest $request): JsonResponse
    {
        $data = $this->patientService->getList(
            $request->getOffset(),
            $request->getLimit()
        );

        return new JsonResponse(
            $data->success ? $data: null,
            $data->success? Response::HTTP_OK : $data->code
        );
    }
}
