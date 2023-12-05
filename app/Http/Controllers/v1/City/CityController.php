<?php

namespace App\Http\Controllers\v1\City;

use App\Http\Controllers\Controller;
use App\Services\City\CityServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    public function __construct(
        protected CityServiceInterface $cityService
    ) {
    }

    public function getCityByName(string $cityName)
    {
        $test = $this->cityService->getCitiesByName($cityName);
        return new JsonResponse($test, Response::HTTP_OK);
    }
}
