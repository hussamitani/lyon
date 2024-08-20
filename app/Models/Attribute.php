<?php

namespace App\Models;

use App\Casts\AttributeSettingsCast;
use App\Enums\AttributeTypeEnum;
use App\Enums\InputFormatEnum;
use App\Mappings\FormFieldMappings;
use App\ValueObjects\AttributeSettings;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute as CastAttribute;

/**
 * @property int $id
 * @property AttributeTypeEnum $attributeType
 * @property string $name
 * @property string|null $description
 * @property int $family_id
 * @property string|null $attribute_options
 * @property bool $required
 * @property string $code
 * @property AttributeSettings $attribute_settings
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
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereAttributeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereRequired($value)
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
            'required' => 'bool',
            'input_format' => InputFormatEnum::class,
            'attribute_settings' => AttributeSettingsCast::class,
        ];
    }

    /**
     * @return CastAttribute
     */
    public function attributeType(): CastAttribute
    {
        return CastAttribute::make(
            get: function (mixed $value, array $attributes) {
                return AttributeSettings::from($attributes['attribute_settings'])->attribute_type;
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
        if (! $this->attributeType) {
            return null;
        }

        return match ($this->attributeType) {
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
