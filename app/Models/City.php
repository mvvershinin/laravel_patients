<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * @property int $id
 * @property string $name
 * @property string $country
 * @property string $state
 * @property float $lat
 * @property float $lon
 * @package App\Models
 */
class City extends Model
{
    use HasFactory;
}
