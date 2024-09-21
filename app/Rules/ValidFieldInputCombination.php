<?php

namespace App\Rules;

use App\Enums\AttributeFormatEnum;
use App\Enums\AttributeTypeEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidFieldInputCombination implements ValidationRule
{
    protected AttributeTypeEnum $fieldType;

    protected AttributeFormatEnum $inputFormat;

    public function __construct(AttributeTypeEnum $fieldType, AttributeFormatEnum $inputFormat)
    {
        $this->fieldType = $fieldType;
        $this->inputFormat = $inputFormat;
    }

    public function passes(): bool
    {
        return in_array($this->inputFormat, $this->fieldType->allowedFormats(), true);
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
