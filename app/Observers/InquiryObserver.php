<?php

namespace App\Observers;

use App\Models\Inquiry;
use Illuminate\Support\Facades\Auth;

class InquiryObserver
{
    public function creating(Inquiry $inquiry): void
    {
        $inquiry->created_by_id = (int) Auth::id();
    }

    public function updating(Inquiry $inquiry): void
    {
        $inquiry->updated_by_id = (int) Auth::id();
    }

    public function deleting(Inquiry $inquiry): void
    {
        $inquiry->deleted_by_id = (int) Auth::id();
    }

    public function restoring(Inquiry $inquiry): void
    {
        $inquiry->deleted_by_id = null;
    }
}
