<?php


namespace App\Services\Patients;

use App\Models\Patient;
use Illuminate\Support\Facades\Cache;

class PatientCacheService
{
    const TAG_PATIENT = 'patients/';
    const TAG_ALL_PATIENTS = 'all_patients';
    const REMEMBER_PATIENT_TTL = 300;

    public function putPatient(Patient $patient): void
    {
        $cacheName = self::TAG_PATIENT.$patient->id;
        Cache::tags([self::TAG_ALL_PATIENTS])->flush();
        Cache::tags([self::TAG_ALL_PATIENTS])->put(
            $cacheName,
            $patient,
            self::REMEMBER_PATIENT_TTL
        );
    }

    public function getList(callable $getList, $offset, $limit)
    {
        $cacheName = self::TAG_PATIENT.$offset.'/'.$limit;
        return Cache::tags([self::TAG_ALL_PATIENTS])
            ->remember($cacheName, self::REMEMBER_PATIENT_TTL, function () use ($getList, $offset, $limit) {
                return $getList($offset,$limit);
            });
    }
}
