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
}
