<?php

namespace App\Models;

use App\Casts\AttributeSettingsCast;
use App\Enums\FieldTypeEnum;
use App\Enums\InputFormatEnum;
use App\Mappings\FormFieldMappings;
use App\ValueObjects\AttributeSettings;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Casts\Attribute as CastAttribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property FieldTypeEnum $type
 * @property InputFormatEnum $input_format
 * @property string $name
 * @property string|null $description
 * @property int $family_id
 * @property string|null $attribute_options
 * @property string $code
 * @property AttributeSettings $settings
 * @property-read Collection<int, Family> $families
 * @property-read int|null $families_count
 *
 * @method static \Database\Factories\ProductAttributeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereAttributeOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCode($value)
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
            'is_distributable' => 'bool',
            'is_territorial' => 'bool',
            'type' => FieldTypeEnum::class,
            'input_format' => InputFormatEnum::class,
            'settings' => AttributeSettingsCast::class,
        ];
    }

    public function settings(): CastAttribute
    {
        return CastAttribute::make(
            get: function (mixed $value, array $attributes) {
                return AttributeSettings::from($attributes['settings']);
            },
        );
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

    public function toFilamentField(): ?Field
    {
        return match ($this->type) {
            FieldTypeEnum::SHORT_TEXT => FormFieldMappings\TextInputMapping::mapAsComponent($this),
            FieldTypeEnum::LONG_TEXT => FormFieldMappings\TextAreaMapping::mapAsComponent($this),
            FieldTypeEnum::SINGLE_SELECT => FormFieldMappings\SingleSelectMapping::mapAsComponent($this),
            FieldTypeEnum::MULTI_SELECT => FormFieldMappings\MultiSelectMapping::mapAsComponent($this),
            FieldTypeEnum::CHECKBOX => FormFieldMappings\CheckboxListMapping::mapAsComponent($this),
            FieldTypeEnum::RADIO => FormFieldMappings\RadioMapping::mapAsComponent($this),
            FieldTypeEnum::TOGGLE => FormFieldMappings\ToggleMapping::mapAsComponent($this),
            FieldTypeEnum::DATE => FormFieldMappings\DatePickerMapping::mapAsComponent($this),
            FieldTypeEnum::DATE_TIME => FormFieldMappings\DateTimePickerMapping::mapAsComponent($this),
        };
    }
}
