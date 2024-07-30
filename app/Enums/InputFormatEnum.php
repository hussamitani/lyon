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
}
