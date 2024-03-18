<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Models\AppointmentVersion;
use Auth;

class AppointmentObserver
{
    public function created(Appointment $appointment): void
    {
        dispatch(fn () => AppointmentVersion::fromAppointment($appointment));
    }

    public function creating(Appointment $appointment): void
    {
        Auth::check() && $appointment->created_by_id = (int) Auth::id();
    }

    public function updated(Appointment $appointment): void
    {
        dispatch(fn () => AppointmentVersion::fromAppointment($appointment));
    }

    public function updating(Appointment $appointment): void
    {
        if ($appointment->deleted_at) {
            Auth::check() && $appointment->deleted_by_id = (int) Auth::id();

            return;
        }

        Auth::check() && $appointment->updated_by_id = (int) Auth::id();
    }

    public function deleted(Appointment $appointment): void
    {
        dispatch(fn () => AppointmentVersion::fromAppointment($appointment));
    }

    public function deleting(Appointment $appointment): void
    {
        Auth::check() && $appointment->deleted_by_id = (int) Auth::id();
    }

    public function softDeleted(Appointment $appointment): void
    {
        dispatch(fn () => AppointmentVersion::fromAppointment($appointment));
    }

    public function softDeleting(Appointment $appointment): void
    {
        Auth::check() && $appointment->deleted_by_id = (int) Auth::id();
    }

    public function restored(Appointment $appointment): void
    {
        dispatch(fn () => AppointmentVersion::fromAppointment($appointment));
    }

    public function restoring(Appointment $appointment): void
    {
        Auth::check() && $appointment->deleted_by_id = null;
    }
}
