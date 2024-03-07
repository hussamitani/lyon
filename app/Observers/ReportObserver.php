<?php

namespace App\Observers;

use App\Models\Report;
use App\Models\ReportVersion;
use Illuminate\Support\Facades\Auth;

class ReportObserver
{
    public function created(Report $report): void
    {
        dispatch(fn () => ReportVersion::fromReport($report));
    }

    public function creating(Report $report): void
    {
        Auth::check() && $report->created_by_id = (int) Auth::id();
    }

    public function updated(Report $report): void
    {
        dispatch(fn () => ReportVersion::fromReport($report));
    }

    public function updating(Report $report): void
    {
        Auth::check() && $report->updated_by_id = (int) Auth::id();
    }

    public function deleted(Report $report): void
    {
        dispatch(fn () => ReportVersion::fromReport($report));
    }

    public function deleting(Report $report): void
    {
        Auth::check() && $report->deleted_by_id = (int) Auth::id();
    }

    public function restored(Report $report): void
    {
        dispatch(fn () => ReportVersion::fromReport($report));
    }

    public function restoring(Report $report): void
    {
        Auth::check() && $report->deleted_by_id = null;
    }
}
