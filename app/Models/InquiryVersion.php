<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
 * @mixin \Eloquent
 */
class InquiryVersion extends Model
{
    protected $table = 'inquiries_versions';

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

    public static function createFromInquiry(Inquiry $inquiry): self
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
