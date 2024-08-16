<?php

namespace App\Models;

use App\Enums\AttributeTypeEnum;
use App\Mappings\FormFieldMappings;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $family_id
 * @property AttributeTypeEnum $attribute_type
 * @property string|null $attribute_options
 * @property bool $required
 *
 * @method static \Database\Factories\ProductAttributeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereAttributeOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereAttributeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereRequired($value)
 *
 * @mixin \Eloquent
 */
class Attribute extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'required' => 'bool',
            'attribute_type' => AttributeTypeEnum::class,
            'attribute_options' => 'array',
        ];
    }

    /**
     * @return BelongsToMany<Family>
     */
    public function families(): BelongsToMany
    {
        return $this->belongsToMany(
            Family::class,
            'family_attributes',
            'attribute_id',
            'family_id',
            'id',
            'id',
        );
    }

    public function toFilamentField(): Field
    {
        return match ($this->attribute_type) {
            AttributeTypeEnum::SHORT_TEXT => FormFieldMappings\TextInputMapping::mapAsComponent($this),
            AttributeTypeEnum::LONG_TEXT => FormFieldMappings\TextAreaMapping::mapAsComponent($this),
            AttributeTypeEnum::SINGLE_SELECT => FormFieldMappings\SingleSelectMapping::mapAsComponent($this),
            AttributeTypeEnum::MULTI_SELECT => FormFieldMappings\MultiSelectMapping::mapAsComponent($this),
            AttributeTypeEnum::CHECKBOX => FormFieldMappings\CheckboxListMapping::mapAsComponent($this),
            AttributeTypeEnum::RADIO => FormFieldMappings\RadioMapping::mapAsComponent($this),
            AttributeTypeEnum::TOGGLE => FormFieldMappings\ToggleMapping::mapAsComponent($this),
            AttributeTypeEnum::DATE => FormFieldMappings\DatePickerMapping::mapAsComponent($this),
            AttributeTypeEnum::DATE_TIME => FormFieldMappings\DateTimePickerMapping::mapAsComponent($this),
        };
    }
}
