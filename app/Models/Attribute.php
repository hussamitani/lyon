<?php

namespace App\Models;

use App\Casts\AttributeSettingsCast;
use App\Enums\AttributeFormatEnum;
use App\Enums\AttributeTypeEnum;
use App\Mappings\FieldTypeMapping;
use App\ValueObjects\AttributeSettings;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Casts\Attribute as CastAttribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property AttributeTypeEnum $type
 * @property AttributeFormatEnum $format
 * @property string $name
 * @property string|null $description
 * @property int $family_id
 * @property string $code
 * @property AttributeSettings $settings
 * @property-read Collection<int, Family> $families
 * @property-read int|null $families_count
 * @property-read AttributeOption[]|Collection<AttributeOption> $options
 * @property-read int $options_count
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
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereInputFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereSettings($value)
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
            'type' => AttributeTypeEnum::class,
            'format' => AttributeFormatEnum::class,
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
        )->withPivot('order')
            ->orderByPivot('order');
    }

    /**
     * @return HasMany<AttributeOption>
     */
    public function options(): HasMany
    {
        return $this->hasMany(AttributeOption::class)->orderBy('order');
    }

    public function toFilamentField(): ?Field
    {
        return match ($this->type) {
            AttributeTypeEnum::SHORT_TEXT => FieldTypeMapping\TextInputMapping::mapAsComponent($this),
            AttributeTypeEnum::LONG_TEXT => FieldTypeMapping\TextAreaMapping::mapAsComponent($this),
            AttributeTypeEnum::SINGLE_SELECT => FieldTypeMapping\SingleSelectMapping::mapAsComponent($this),
            AttributeTypeEnum::MULTI_SELECT => FieldTypeMapping\MultiSelectMapping::mapAsComponent($this),
            AttributeTypeEnum::CHECKBOX => FieldTypeMapping\CheckboxListMapping::mapAsComponent($this),
            AttributeTypeEnum::RADIO => FieldTypeMapping\RadioMapping::mapAsComponent($this),
            AttributeTypeEnum::TOGGLE => FieldTypeMapping\ToggleMapping::mapAsComponent($this),
            AttributeTypeEnum::DATE => FieldTypeMapping\DatePickerMapping::mapAsComponent($this),
            AttributeTypeEnum::DATE_TIME => FieldTypeMapping\DateTimePickerMapping::mapAsComponent($this),
        };
    }
}
