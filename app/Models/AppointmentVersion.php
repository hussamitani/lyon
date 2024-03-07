<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $appointment_id
 * @property int $patient_id
 * @property int $type_id
 * @property string $begins_at
 * @property string $ends_at
 * @property string $subject
 * @property string $description
 * @property string $location
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property int|null $deleted_by_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereBeginsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentVersion whereUpdatedById($value)
 *
 * @mixin \Eloquent
 */
class AppointmentVersion extends Model
{
    protected $table = 'appointments_versions';

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'begins_at' => 'datetime',
            'ends_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public static function fromAppointment(Appointment $appointment): self
    {
        $appointmentData = $appointment->toArray();
        $appointmentData['appointment_id'] = $appointmentData['id'];
        unset($appointmentData['id']);
        $appointmentData['begins_at'] = $appointment->getAttributeValue('begins_at');
        $appointmentData['ends_at'] = $appointment->getAttributeValue('ends_at');
        $appointmentData['created_at'] = $appointment->getAttributeValue('created_at');
        $appointmentData['updated_at'] = $appointment->getAttributeValue('updated_at');
        $appointmentData['deleted_at'] = $appointment->getAttributeValue('deleted_at');

        return self::create($appointmentData);
    }
}
