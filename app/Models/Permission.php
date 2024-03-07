<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        self::PDMS_VIEW_PATIENT,
        self::PDMS_MANAGE_PATIENT,
        self::PDMS_DELETE_PATIENT,
        self::PDMS_VIEW_APPOINTMENT,
        self::PDMS_MANAGE_APPOINTMENT,
        self::PDMS_DELETE_APPOINTMENT,
        self::PDMS_VIEW_INQUIRY,
        self::PDMS_MANAGE_INQUIRY,
        self::PDMS_DELETE_INQUIRY,
        self::PDMS_VIEW_INQUIRY_RESPONSE,
        self::PDMS_MANAGE_INQUIRY_RESPONSE,
        self::PDMS_DELETE_INQUIRY_RESPONSE,
        self::PDMS_VIEW_REPORT,
        self::PDMS_MANAGE_REPORT,
        self::PDMS_DELETE_REPORT,
        self::SYSTEM_MANAGE_APPOINTMENT_TYPE,
        self::SYSTEM_MANAGE_INQUIRY_TYPE,
        self::SYSTEM_MANAGE_INQUIRY_STATUS,
        self::ADMIN_VIEW_USERS,
        self::ADMIN_MANAGE_USERS,
        self::ADMIN_DELETE_USERS,
        self::ADMIN_VIEW_ROLES,
        self::ADMIN_MANAGE_ROLES,
        self::ADMIN_DELETE_ROLES,
        self::ADMIN_VIEW_PERMISSIONS,
    ];

    public const PDMS_VIEW_PATIENT = 'pdms_create_patient';

    public const PDMS_MANAGE_PATIENT = 'pdms_manage_patient';

    public const PDMS_DELETE_PATIENT = 'pdms_delete_patient';

    public const PDMS_VIEW_APPOINTMENT = 'pdms_view_appointment';

    public const PDMS_MANAGE_APPOINTMENT = 'pdms_manage_appointment';

    public const PDMS_DELETE_APPOINTMENT = 'pdms_delete_appointment';

    public const PDMS_VIEW_INQUIRY = 'pdms_view_inquiry';

    public const PDMS_MANAGE_INQUIRY = 'pdms_manage_inquiry';

    public const PDMS_DELETE_INQUIRY = 'pdms_delete_inquiry';

    public const PDMS_VIEW_INQUIRY_RESPONSE = 'pdms_view_inquiry_response';

    public const PDMS_MANAGE_INQUIRY_RESPONSE = 'pdms_manage_inquiry_response';

    public const PDMS_DELETE_INQUIRY_RESPONSE = 'pdms_delete_inquiry_response';

    public const PDMS_VIEW_REPORT = 'pdms_view_report';

    public const PDMS_MANAGE_REPORT = 'pdms_manage_report';

    public const PDMS_DELETE_REPORT = 'pdms_delete_report';

    public const SYSTEM_MANAGE_APPOINTMENT_TYPE = 'system_manage_appointment_type';

    public const SYSTEM_MANAGE_INQUIRY_TYPE = 'system_manage_inquiry_type';

    public const SYSTEM_MANAGE_INQUIRY_STATUS = 'system_manage_inquiry_status';

    public const ADMIN_VIEW_USERS = 'admin_view_users';

    public const ADMIN_MANAGE_USERS = 'admin_manage_users';

    public const ADMIN_DELETE_USERS = 'admin_delete_users';

    public const ADMIN_VIEW_ROLES = 'admin_view_roles';

    public const ADMIN_MANAGE_ROLES = 'admin_manage_roles';

    public const ADMIN_DELETE_ROLES = 'admin_delete_roles';

    public const ADMIN_VIEW_PERMISSIONS = 'admin_view_permissions';

    protected $guarded = [];

    /**
     * @return Attribute<string, never>
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes): string => trans("permissions.{$attributes['key']}.name")
        );
    }

    /**
     * @return Attribute<string, never>
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes): string => trans("permissions.{$attributes['key']}.description")
        );
    }

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
