<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $qid
 * @property mixed $password
 * @property Carbon $birthday
 * @property string $gender
 * @property-read string $name
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, Appointment> $appointments
 * @property-read int|null $appointments_count
 * @property-read Collection<int, Inquiry> $inquiries
 * @property-read int|null $inquiries_count
 * @property-read Collection<int, Report> $reports
 * @property-read int|null $reports_count
 *
 * @method static \Database\Factories\PatientFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereQid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereFirstnameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereFirstnameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereLastnameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereLastnameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereLastname($value)
 *
 * @mixin \Eloquent
 */
class Patient extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'qid',
        'password',
        'birthday',
        'gender',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'birthday' => 'date',
            'password' => 'hashed',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'qid';
    }

    public function getRouteKey(): string
    {
        return $this->qid;
    }

    /**
     * @return Attribute<string, never>
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes): string => $attributes['firstname'].' '.$attributes['lastname']
        );
    }

    /**
     * @return HasMany<Inquiry>
     */
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    /**
     * @return HasMany<Appointment>
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * @return HasMany<Report>
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
