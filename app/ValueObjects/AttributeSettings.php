<?php

namespace App\ValueObjects;

use App\Enums\AttributeTypeEnum;
use App\Enums\InputFormatEnum;

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
