<?php

namespace App\Models;

use App\Concerns\HasAuthor;
use App\Observers\ReportObserver;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $patient_id
 * @property string $subject
 * @property string $description
 * @property array|null $files
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property int|null $deleted_by_id
 * @property-read User|null $createdBy
 * @property-read User|null $deletedBy
 * @property-read User|null $updatedBy
 * @property-read Patient $patient
 * @property-read Collection<int, ReportVersion> $versions
 * @property-read int|null $versions_count
 *
 * @method static \Database\Factories\ReportFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report query()
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Report withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Report withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUpdatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereFiles($value)
 *
 * @mixin \Eloquent
 */
class Report extends Model
{
    use HasAuthor, HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        parent::booted();

        self::observe(ReportObserver::class);
    }

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'files' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Patient, Report>
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * @return HasMany<ReportVersion>
     */
    public function versions(): HasMany
    {
        return $this->hasMany(ReportVersion::class);
    }
}
