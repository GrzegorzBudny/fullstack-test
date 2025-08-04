<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;

class PurchaseDateInRangeRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        try {
            $date = Carbon::createFromFormat('d-m-Y', $value);
            $min = Carbon::createFromFormat('d-m-Y', '23-07-2025');
            $max = Carbon::createFromFormat('d-m-Y', '22-08-2025');
            return $date->between($min, $max);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function message()
    {
        return 'Data zakupu musi być między 23.07.2025 a 22.08.2025.';
    }
}
