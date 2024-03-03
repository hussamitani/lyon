<?php

namespace App\Models;

use App\Concerns\HasPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 *
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
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
 * @mixin \Eloquent
 */
class Permission extends Model
{
    use HasFactory, HasPermission;

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

    protected $guarded = [];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'roles_permissions'
        );
    }
}
