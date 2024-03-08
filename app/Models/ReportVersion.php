<?php

namespace App\Models;

use App\Concerns\HasAuthor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $report_id
 * @property int $patient_id
 * @property string $subject
 * @property string $description
 * @property string|null $files
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property int|null $deleted_by_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion whereFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion whereReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportVersion whereUpdatedById($value)
 *
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\User|null $deletedBy
 * @property-read \App\Models\User|null $updatedBy
 *
 * @mixin \Eloquent
 */
class ReportVersion extends Model
{
    use HasAuthor;

    protected $table = 'reports_versions';

    public $timestamps = false;

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public static function fromReport(Report $report): self
    {
        $reportData = $report->toArray();
        $reportData['report_id'] = $reportData['id'];
        unset($reportData['id']);
        $reportData['created_at'] = $report->getAttributeValue('created_at');
        $reportData['updated_at'] = $report->getAttributeValue('updated_at');
        $reportData['deleted_at'] = $report->getAttributeValue('deleted_at');

        return self::create($reportData);
    }
}
