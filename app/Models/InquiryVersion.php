<?php

namespace App\Models;

use App\Concerns\HasAuthor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Carbon;

/**
 * @property int $inquiry_id
 * @property int $patient_id
 * @property int $type_id
 * @property string $subject
 * @property string $description
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property int|null $deleted_by_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion whereInquiryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryVersion whereUpdatedById($value)
 *
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\User|null $deletedBy
 * @property-read \App\Models\InquiryStatus|null $status
 * @property-read \App\Models\InquiryType $type
 * @property-read \App\Models\User|null $updatedBy
 *
 * @mixin \Eloquent
 */
class InquiryVersion extends Model
{
    use HasAuthor;

    protected $table = 'inquiries_versions';

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

    /**
     * @return BelongsTo<InquiryType, InquiryVersion>
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(InquiryType::class);
    }

    /**
     * @return HasOneThrough<InquiryStatus>
     */
    public function status(): HasOneThrough
    {
        return $this->hasOneThrough(
            InquiryStatus::class,
            InquiryResponse::class,
            'inquiry_id',
            'id',
            'inquiry_id',
            'status_id',
        )
            ->where('inquiries_responses.created_at', '<', 'inquiries_versions.created_at')
            ->orderByDesc('inquiries_responses.created_at');
    }

    public static function fromInquiry(Inquiry $inquiry): self
    {
        $inquiryData = $inquiry->toArray();
        $inquiryData['inquiry_id'] = $inquiryData['id'];
        unset($inquiryData['id']);
        $inquiryData['created_at'] = $inquiry->getAttributeValue('created_at');
        $inquiryData['updated_at'] = $inquiry->getAttributeValue('updated_at');
        $inquiryData['deleted_at'] = $inquiry->getAttributeValue('deleted_at');

        return self::create($inquiryData);
    }
}
