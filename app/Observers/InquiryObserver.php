<?php

namespace App\Observers;

use App\Models\Inquiry;
use App\Models\InquiryVersion;
use Illuminate\Support\Facades\Auth;

class InquiryObserver
{
    public function created(Inquiry $inquiry): void
    {
        dispatch(fn () => InquiryVersion::fromInquiry($inquiry));
    }

    public function creating(Inquiry $inquiry): void
    {
        Auth::check() && $inquiry->created_by_id = (int) Auth::id();
    }

    public function updated(Inquiry $inquiry): void
    {
        dispatch(fn () => InquiryVersion::fromInquiry($inquiry));
    }

    public function updating(Inquiry $inquiry): void
    {
        Auth::check() && $inquiry->updated_by_id = (int) Auth::id();
    }

    public function deleted(Inquiry $inquiry): void
    {
        dispatch(fn () => InquiryVersion::fromInquiry($inquiry));
    }

    public function deleting(Inquiry $inquiry): void
    {
        Auth::check() && $inquiry->deleted_by_id = (int) Auth::id();
    }

    public function restored(Inquiry $inquiry): void
    {
        dispatch(fn () => InquiryVersion::fromInquiry($inquiry));
    }

    public function restoring(Inquiry $inquiry): void
    {
        Auth::check() && $inquiry->deleted_by_id = null;
    }
}
