<?php

namespace App\Models;

use App\Concerns\HasAuthor;
use App\Observers\AppointmentObserver;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property int $patient_id
 * @property int $type_id
 * @property string $begins_at
 * @property string $ends_at
 * @property string $subject
 * @property string $description
 * @property string $location
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Patient $patient
 * @property-read AppointmentType $type
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property int|null $deleted_by_id
 * @property-read User|null $createdBy
 * @property-read User|null $deletedBy
 * @property-read User|null $updatedBy
 * @property-read Collection<int, AppointmentVersion> $versions
 * @property-read int|null $versions_count
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
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereUpdatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Appointment extends Model
{
    use HasAuthor, HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        parent::booted();

        self::onDelete(function (Appointment $appointment) {
            Auth::check() && $appointment->deleted_by_id = (int) Auth::id();

            $appointment->saveQuietly();
        });

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

    /**
     * @return HasMany<AppointmentVersion>
     */
    public function versions(): HasMany
    {
        return $this->hasMany(AppointmentVersion::class)
            ->whereNot('updated_at', $this->updated_at)
            ->orderBy('created_at');
    }
}
