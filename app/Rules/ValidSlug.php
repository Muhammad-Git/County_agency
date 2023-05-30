<?php

namespace App\Rules;
use DB;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class ValidSlug implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        // Check if the value only contains lowercase letters, numbers and dashes
        if (! preg_match('/^[a-z0-9-]+$/', $value)) {
            return false;
        }

        // Check if the value is unique in the "your_table_name" table
        return ! DB::table('video_artists')->where('slug', $value)->exists();
    }

    public function message()
    {
        return 'The :attribute must be a valid unique slug.';
    }
}
