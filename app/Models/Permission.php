<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Role> $roles
 * @property-read int|null $roles_count
 *
 * @method static \Database\Factories\PermissionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Permission extends Model
{
    use HasFactory;

    public $timestamps = false;

    public const ALL = [
        self::VIEW_APPOINTMENT,
        self::MANAGE_APPOINTMENT,
        self::VIEW_INQUIRY,
        self::MANAGE_INQUIRY,
        self::UPDATE_INQUIRY_STATUS,
        self::VIEW_REPORT,
        self::MANAGE_REPORT,
        self::MANAGE_APPOINTMENT_TYPE,
        self::MANAGE_INQUIRY_TYPE,
        self::MANAGE_INQUIRY_STATUS_TYPE,
        self::CREATE_PATIENT,
    ];

    public const VIEW_APPOINTMENT = 'view_appointment';

    public const MANAGE_APPOINTMENT = 'manage_appointment';

    public const VIEW_INQUIRY = 'view_inquiry';

    public const MANAGE_INQUIRY = 'manage_inquiry';

    public const UPDATE_INQUIRY_STATUS = 'update_report_status';

    public const VIEW_REPORT = 'view_report';

    public const MANAGE_REPORT = 'manage_report';

    public const MANAGE_APPOINTMENT_TYPE = 'manage_appointment_type';

    public const MANAGE_INQUIRY_TYPE = 'manage_inquiry_type';

    public const MANAGE_INQUIRY_STATUS_TYPE = 'manage_inquiry_status_type';

    public const CREATE_PATIENT = 'create_patient';

    protected $guarded = [];

    /**
     * @return BelongsToMany<Role>
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'roles_permissions'
        );
    }
}
