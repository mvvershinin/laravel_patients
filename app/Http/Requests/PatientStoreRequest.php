<?php

namespace App\Http\Requests;

use App\Models\Patient;
use App\Services\Patients\Dto\PatientDto;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Foundation\Http\FormRequest;

class PatientStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birthdate' => 'required|date|before:tomorrow'
        ];
    }

    public function getBirthday(): CarbonInterface
    {
        return new Carbon($this->birthdate);
    }

    public function getAgeType(): object
    {
        $now = CarbonImmutable::now();
        $birthday = $this->getBirthday();

        if ($now->diffInYears($birthday)) {
            return (object)[
                'type' => Patient::AGE_TYPE_YEAR,
                'age' => $now->diffInYears($birthday),
            ];
        };

        if ($now->diffInMonths($birthday)) {
            return (object)[
                'type' => Patient::AGE_TYPE_MONTH,
                'age' => $now->diffInMonths($birthday),
            ];
        }

        return (object)[
            'type' => Patient::AGE_TYPE_DAY,
            'age' => $now->diffInDays($birthday),
        ];

    }

    public function getPatientDto()
    {
        $ageObject = $this->getAgeType();

        return new PatientDto(
            $this->first_name,
            $this->last_name,
            Carbon::parse($this->birthdate),
            $ageObject->type,
            $ageObject->age,
        );
    }
}
