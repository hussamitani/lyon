<?php

namespace App\ValueObjects;

use App\Enums\FieldTypeEnum;
use App\Enums\InputFormatEnum;
use Exception;

readonly class AttributeSettings
{
    public function __construct(
        public FieldTypeEnum $type,
        public InputFormatEnum $input_format,
        public bool $is_required,
        public bool $is_distributable,
        public bool $is_territorial,
    ) {
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function mutateBeforeFill(array $data): array
    {
        $attributeSettings = $data['settings'];

        $data['type'] = $attributeSettings['type'];
        $data['input_format'] = $attributeSettings['input_format'];
        $data['is_required'] = $attributeSettings['is_required'];
        $data['is_distributable'] = $attributeSettings['is_distributable'];
        $data['is_territorial'] = $attributeSettings['is_territorial'];

        unset($data['settings']);

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function mutateBeforeSave(array $data): array
    {
        $data['settings'] = new AttributeSettings(
            type: $data['type'],
            input_format: $data['input_format'],
            is_required: $data['is_required'],
            is_distributable: $data['is_distributable'],
            is_territorial: $data['is_territorial'],
        );

        //unset($data['type']);
        unset($data['input_format']);
        unset($data['is_required']);
        unset($data['is_distributable']);
        unset($data['is_territorial']);

        return $data;
    }

    /**
     * @throws Exception
     */
    public static function from(mixed $settings): self
    {
        if (is_array($settings)) {
            return new AttributeSettings(
                type: $settings['type'],
                input_format: $settings['input_format'],
                is_required: $settings['is_required'],
                is_distributable: $settings['is_distributable'],
                is_territorial: $settings['is_territorial'],
            );
        }

        if (is_string($settings)) {
            $attribute_settings_array = json_decode($settings, true);

            return new AttributeSettings(
                type: FieldTypeEnum::from($attribute_settings_array['type']),
                input_format: InputFormatEnum::from($attribute_settings_array['input_format']),
                is_required: $attribute_settings_array['is_required'],
                is_distributable: $attribute_settings_array['is_distributable'],
                is_territorial: $attribute_settings_array['is_territorial'],
            );
        }

        throw new Exception('Could not parse attribute settings data');
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type->value,
            'input_format' => $this->input_format->value,
            'is_required' => $this->is_required,
            'is_distributable' => $this->is_distributable,
            'is_territorial' => $this->is_territorial,
        ];
    }
}
