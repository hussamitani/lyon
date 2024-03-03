<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $patient_id
 * @property int $type_id
 * @property string $subject
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Database\Factories\InquiryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Inquiry extends Model
{
    use HasFactory;
}
