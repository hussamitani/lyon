<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static \Database\Factories\AppointmentTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType query()
 *
 * @property-read Collection<int, Appointment> $appointments
 * @property-read int|null $appointments_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType withoutTrashed()
 *
 * @mixin \Eloquent
 */
class AppointmentType extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return HasMany<Appointment>
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
