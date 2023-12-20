<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Patient
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property Carbon $birthdate
 * @property int $age
 * @property string $age_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */
class Patient extends Model
{
    use HasFactory;

    const AGE_TYPE_DAY = 'days';
    const AGE_TYPE_MONTH = 'months';
    const AGE_TYPE_YEAR = 'years';

    const AGE_LOCALE = [
        self::AGE_TYPE_DAY => 'день',
        self::AGE_TYPE_MONTH => 'месяц',
        self::AGE_TYPE_YEAR => 'год',
    ];

    public function getAgeString(): string
    {
        return $this->age.' '.self::AGE_LOCALE[$this->age_type];
    }
}
