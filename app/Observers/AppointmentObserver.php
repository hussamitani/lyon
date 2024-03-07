<?php

namespace App\Observers;

use App\Models\Appointment;
use Auth;

class AppointmentObserver
{
    public function creating(Appointment $appointment): void
    {
        $appointment->created_by_id = (int) Auth::id();
    }

    public function updating(Appointment $appointment): void
    {
        $appointment->updated_by_id = (int) Auth::id();
    }

    public function deleting(Appointment $appointment): void
    {
        $appointment->deleted_by_id = (int) Auth::id();
    }

    public function restored(Appointment $appointment): void
    {
        $appointment->deleted_by_id = null;
    }
}
