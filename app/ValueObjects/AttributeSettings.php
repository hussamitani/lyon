<?php

namespace App\ValueObjects;

use Exception;

readonly class AttributeSettings
{
    public function __construct(
        public bool $is_distributable,
        public bool $is_territorial,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function mutateBeforeFill(array $data): array
    {
        $attributeSettings = $data['settings'];

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
            is_distributable: $data['is_distributable'],
            is_territorial: $data['is_territorial'],
        );

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
                is_distributable: $settings['is_distributable'],
                is_territorial: $settings['is_territorial'],
            );
        }

        if (is_string($settings)) {
            $attribute_settings_array = json_decode($settings, true);

            return new AttributeSettings(
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
            'is_distributable' => $this->is_distributable,
            'is_territorial' => $this->is_territorial,
        ];
    }
}
