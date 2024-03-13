<?php

namespace App\Observers;

use App\Models\InquiryResponse;
use Illuminate\Support\Facades\Auth;

class InquiryResponseObserver
{
    public function creating(InquiryResponse $inquiryResponse): void
    {
        Auth::check() && $inquiryResponse->created_by_id = (int) Auth::id();
    }

    public function updating(InquiryResponse $inquiryResponse): void
    {
        Auth::check() && $inquiryResponse->updated_by_id = (int) Auth::id();
    }

    public function deleting(InquiryResponse $inquiryResponse): void
    {
        Auth::check() && $inquiryResponse->deleted_by_id = (int) Auth::id();
    }

    public function restoring(InquiryResponse $inquiryResponse): void
    {
        Auth::check() && $inquiryResponse->deleted_by_id = null;
    }
}
