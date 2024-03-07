<?php

namespace App\Observers;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportObserver
{
    public function creating(Report $report): void
    {
        $report->created_by_id = (int) Auth::id();
    }

    public function updating(Report $report): void
    {
        $report->updated_by_id = (int) Auth::id();
    }

    public function deleting(Report $report): void
    {
        $report->deleted_by_id = (int) Auth::id();
    }

    public function restoring(Report $report): void
    {
        $report->deleted_by_id = null;
    }
}
