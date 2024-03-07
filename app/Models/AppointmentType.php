<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
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
 * @property int $id
 * @property string|null $key
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class AppointmentType extends Model
{
    use SoftDeletes;

    protected $table = 'appointments_types';

    /**
     * @return HasMany<Appointment>
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
