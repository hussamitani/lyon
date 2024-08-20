<?php

namespace App\Casts;

use App\Enums\AttributeTypeEnum;
use App\Enums\InputFormatEnum;
use App\ValueObjects\AttributeSettings;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @implements CastsAttributes<array<string, mixed>, string>
 */
class AttributeSettingsCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): array
    {
        $settings = json_decode($value, true);

        $attributeSettings = new AttributeSettings(
            AttributeTypeEnum::from($settings['attribute_type']),
            InputFormatEnum::from($settings['input_format']),
            $settings['is_required'],
            $settings['is_distributable'],
            $settings['is_territorial'],
        );

        return $attributeSettings->toArray();
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  AttributeSettings|mixed  $value
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed>
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        return ['attribute_settings' => json_encode($value)];
    }
}
