<?php

namespace App\Rules;

use App\Enums\FieldTypeEnum;
use App\Enums\InputFormatEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidFieldInputCombination implements ValidationRule
{
    protected FieldTypeEnum $fieldType;

    protected InputFormatEnum $inputFormat;

    public function __construct(FieldTypeEnum $fieldType, InputFormatEnum $inputFormat)
    {
        $this->fieldType = $fieldType;
        $this->inputFormat = $inputFormat;
    }

    public function passes(): bool
    {
        return in_array($this->inputFormat, $this->fieldType->inputFormat(), true);
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->validate($attribute, $value, $fail);
    }
}
