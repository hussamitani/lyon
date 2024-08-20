<?php

namespace App\ValueObjects;

use App\Enums\AttributeTypeEnum;
use App\Enums\InputFormatEnum;
use http\Exception\RuntimeException;

readonly class AttributeSettings
{
    public function __construct(
        public AttributeTypeEnum $attribute_type,
        public InputFormatEnum $input_format,
        public bool $is_required,
        public bool $is_distributable,
        public bool $is_territorial,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    public static function mutateBeforeFill(array $data): array
    {
        $attributeSettings = $data['attribute_settings'];

        $data['attribute_type'] = $attributeSettings['attribute_type'];
        $data['input_format'] = $attributeSettings['input_format'];
        $data['is_required'] = $attributeSettings['is_required'];
        $data['is_distributable'] = $attributeSettings['is_distributable'];
        $data['is_territorial'] = $attributeSettings['is_territorial'];

        unset($data['attribute_settings']);

        return $data;
    }

    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    public static function mutateBeforeSave(array $data): array
    {
        $data['attribute_settings'] = new AttributeSettings(
            attribute_type: $data['attribute_type'],
            input_format: $data['input_format'],
            is_required: $data['is_required'],
            is_distributable: $data['is_distributable'],
            is_territorial: $data['is_territorial'],
        );

        //unset($data['attribute_type']);
        unset($data['input_format']);
        unset($data['is_required']);
        unset($data['is_distributable']);
        unset($data['is_territorial']);

        return $data;
    }

    public static function from(mixed $attribute_settings): self
    {
        if (is_array($attribute_settings)) {
            return new AttributeSettings(
                attribute_type: $attribute_settings['attribute_type'],
                input_format: $attribute_settings['input_format'],
                is_required: $attribute_settings['is_required'],
                is_distributable: $attribute_settings['is_distributable'],
                is_territorial: $attribute_settings['is_territorial'],
            );
        }

        if (is_string($attribute_settings)) {
            $attribute_settings_array = json_decode($attribute_settings, true);
            return new AttributeSettings(
                attribute_type: AttributeTypeEnum::from($attribute_settings_array['attribute_type']),
                input_format: InputFormatEnum::from($attribute_settings_array['input_format']),
                is_required: $attribute_settings_array['is_required'],
                is_distributable: $attribute_settings_array['is_distributable'],
                is_territorial: $attribute_settings_array['is_territorial'],
            );
        }

        throw new RuntimeException("Could not parse attribute settings data");
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'attribute_type' => $this->attribute_type->value,
            'input_format' => $this->input_format->value,
            'is_required' => $this->is_required,
            'is_distributable' => $this->is_distributable,
            'is_territorial' => $this->is_territorial,
        ];
    }
}
