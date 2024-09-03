<?php

namespace App\Enums;

enum FieldTypeEnum: string
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
     * @return array<InputFormatEnum>
     */
    public function inputFormat(): array
    {
        return match ($this) {
            self::SHORT_TEXT => [
                InputFormatEnum::TEXT,
                InputFormatEnum::INTEGER,
                InputFormatEnum::DECIMAL,
                InputFormatEnum::CURRENCY,
                InputFormatEnum::COLOR,
            ],
            self::LONG_TEXT => [
                InputFormatEnum::TEXT,
            ],
            self::SINGLE_SELECT => [
                InputFormatEnum::TEXT,
                InputFormatEnum::BOOLEAN,
                InputFormatEnum::INTEGER,
            ],
            self::MULTI_SELECT => [
                InputFormatEnum::TEXT,
                InputFormatEnum::INTEGER,
            ],
            self::CHECKBOX => [
                InputFormatEnum::BOOLEAN,
            ],
            self::RADIO => [
                InputFormatEnum::BOOLEAN,
                InputFormatEnum::TEXT,
            ],
            self::TOGGLE => [
                InputFormatEnum::BOOLEAN,
                InputFormatEnum::PERCENTAGE,
            ],
            self::DATE => [
                InputFormatEnum::DATE,
            ],
            self::DATE_TIME => [
                InputFormatEnum::DATETIME,
            ]
        };
    }
}
