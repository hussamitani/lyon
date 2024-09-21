<?php

namespace App\Enums;

enum AttributeTypeEnum: string
{
    case SHORT_TEXT = 'short_text';
    case LONG_TEXT = 'long_text';
    case SINGLE_SELECT = 'single_select';
    case MULTI_SELECT = 'multi_select';
    case CHECKBOX = 'checkbox';
    case RADIO = 'radio';
    case TOGGLE = 'toggle';
    case DATE = 'date';
    case DATE_TIME = 'datetime';

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }

    /**
     * @return array<AttributeFormatEnum>
     */
    public function allowedFormats(): array
    {
        return match ($this) {
            self::SHORT_TEXT => [
                AttributeFormatEnum::TEXT,
                AttributeFormatEnum::INTEGER,
                AttributeFormatEnum::DECIMAL,
                AttributeFormatEnum::CURRENCY,
                AttributeFormatEnum::COLOR,
            ],
            self::LONG_TEXT => [
                AttributeFormatEnum::TEXT,
            ],
            self::SINGLE_SELECT => [
                AttributeFormatEnum::TEXT,
                AttributeFormatEnum::BOOLEAN,
                AttributeFormatEnum::INTEGER,
            ],
            self::MULTI_SELECT => [
                AttributeFormatEnum::TEXT,
                AttributeFormatEnum::INTEGER,
            ],
            self::CHECKBOX => [
                AttributeFormatEnum::BOOLEAN,
            ],
            self::RADIO => [
                AttributeFormatEnum::BOOLEAN,
                AttributeFormatEnum::TEXT,
            ],
            self::TOGGLE => [
                AttributeFormatEnum::BOOLEAN,
                AttributeFormatEnum::PERCENTAGE,
            ],
            self::DATE => [
                AttributeFormatEnum::DATE,
            ],
            self::DATE_TIME => [
                AttributeFormatEnum::DATETIME,
            ]
        };
    }
}
