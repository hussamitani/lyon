<?php

namespace App\Models;

use App\Concerns\HasAuthor;
use App\Observers\AppointmentObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $patient_id
 * @property int $type_id
 * @property string $begins_at
 * @property string $ends_at
 * @property string $subject
 * @property string $description
 * @property string $location
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static \Database\Factories\AppointmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereBeginsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereUpdatedAt($value)
 *
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\AppointmentType $type
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property int|null $deleted_by_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereUpdatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment withoutTrashed()
 *
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\User|null $deletedBy
 * @property-read \App\Models\User|null $updatedBy
 *
 * @mixin \Eloquent
 */
class Appointment extends Model
{
    use HasAuthor, HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        parent::booted();

        self::observe(AppointmentObserver::class);
    }

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'begins_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<AppointmentType, Appointment>
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(AppointmentType::class);
    }

    /**
     * @return BelongsTo<Patient, Appointment>
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
