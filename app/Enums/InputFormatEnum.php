<?php

namespace App\Enums;

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

    public function filamentMask(): ?string
    {
        return match ($this) {
            self::TEXT => null, // No mask for plain text
            self::INTEGER => '999999', // Simple numeric mask
            self::DECIMAL => '999999.99', // Mask for decimal numbers
            self::CURRENCY => '$999,999.99', // Currency format
            self::PERCENTAGE => '99%', // Percentage format
            self::DATE => '00/00/0000', // Date format MM/DD/YYYY
            self::TIME => '00:00', // Time format HH:MM
            self::DATETIME => '00/00/0000 00:00', // DateTime format
            self::COLOR => '#HHHHHH', // Hex color code
            // Add masks for other formats as needed
            default => null, // No mask by default
        };
    }

    public function filamentRule(): string
    {
        return match ($this) {
            self::TEXT => 'string|max:255',
            self::INTEGER => 'integer',
            self::DECIMAL => 'numeric',
            self::CURRENCY => 'regex:/^\$?\d+(\.\d{2})?$/',
            self::PERCENTAGE => 'numeric|between:0,100',
            self::DATE => 'date_format:m/d/Y',
            self::TIME => 'date_format:H:i',
            self::DATETIME => 'date_format:m/d/Y H:i',
            self::COLOR => 'regex:/^#[0-9A-Fa-f]{6}$/',
            default => 'string',
        };
    }

    public function defaultValue(): string|int|float|null
    {
        return match ($this) {
            self::TEXT => '',
            self::INTEGER => 0,
            self::DECIMAL => 0.00,
            self::CURRENCY => '$0.00',
            self::PERCENTAGE => '0%',
            self::DATE => now()->format('m/d/Y'),
            self::TIME => now()->format('H:i'),
            self::DATETIME => now()->format('m/d/Y H:i'),
            self::COLOR => '#000000',
            default => '',
        };
    }
}
