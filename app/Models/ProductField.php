<?php

namespace App\Models;

use App\Enums\FieldTypeEnum;
use App\Mappings;
use Filament\Forms\Components;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $family_id
 * @property FieldTypeEnum $field_type
 * @property string|null $field_options
 * @property bool $required
 * @property-read Family $family
 *
 * @method static \Database\Factories\ProductFieldFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField whereFieldOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField whereFieldType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField whereRequired($value)
 *
 * @mixin \Eloquent
 */
class ProductField extends Model
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
            'field_type' => FieldTypeEnum::class,
        ];
    }

    /**
     * @return BelongsTo<Family, ProductField>
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    /**
     * @return Field
     */
    public function toFilamentField(): Components\Field
    {
        return match ($this->field_type) {
            FieldTypeEnum::SHORT_TEXT => Mappings\FormFieldMappings\TextInputMapping::mapAsComponent($this),
            FieldTypeEnum::LONG_TEXT => Mappings\FormFieldMappings\TextAreaMapping::mapAsComponent($this),
            FieldTypeEnum::SINGLE_SELECT => Mappings\FormFieldMappings\SingleSelectMapping::mapAsComponent($this),
            FieldTypeEnum::MULTI_SELECT => Mappings\FormFieldMappings\MultiSelectMapping::mapAsComponent($this),
            FieldTypeEnum::CHECKBOX => Mappings\FormFieldMappings\CheckboxListMapping::mapAsComponent($this),
            FieldTypeEnum::RADIO => Mappings\FormFieldMappings\RadioMapping::mapAsComponent($this),
            FieldTypeEnum::TOGGLE => Mappings\FormFieldMappings\ToggleMapping::mapAsComponent($this),
            FieldTypeEnum::DATE => Mappings\FormFieldMappings\DatePickerMapping::mapAsComponent($this),
            FieldTypeEnum::DATE_TIME => Mappings\FormFieldMappings\DateTimePickerMapping::mapAsComponent($this),
        };
    }
}
