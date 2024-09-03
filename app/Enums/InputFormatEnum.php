<?php

namespace App\Enums;

use App\Mappings\FormFieldSetup\CurrencyFieldSetup;
use App\Mappings\FormFieldSetup\IntegerFieldSetup;
use Filament\Forms\Components\Field;

enum InputFormatEnum: string
{
    case TEXT = 'text';
    case INTEGER = 'integer';
    case DECIMAL = 'decimal';
    case BOOLEAN = 'boolean';
    case CURRENCY = 'currency';
    case WEIGHT = 'weight';
    case LENGTH = 'length';
    case AREA = 'area';
    case VOLUME = 'volume';
    case DATE = 'date';
    case TIME = 'time';
    case DATETIME = 'datetime';
    case PERCENTAGE = 'percentage';
    case NUMBER = 'number';
    case COLOR = 'color';

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }

    public function setup(Field $field): Field
    {
        return match ($this) {
            self::TEXT => $field,
            self::INTEGER => IntegerFieldSetup::setup($field),
            self::DECIMAL => $field,
            self::BOOLEAN => $field,
            self::CURRENCY => CurrencyFieldSetup::setup($field),
            self::WEIGHT => $field,
            self::LENGTH => $field,
            self::AREA => $field,
            self::VOLUME => $field,
            self::DATE => $field,
            self::TIME => $field,
            self::DATETIME => $field,
            self::PERCENTAGE => $field,
            self::NUMBER => $field,
            self::COLOR => $field,
        };
    }
}
