<?php

namespace App\Rules;

use App\Models\Country;
use Illuminate\Contracts\Validation\Rule;

class ValidatePersonalIdTypeFormat implements Rule
{
    protected $personal_id_type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $personal_id_type)
    {
        $this->personal_id_type = $personal_id_type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->personal_id_type == Country::ID_TYPE_MYKAD) {
            return preg_match_all('%(([[0-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01]))-([0-9]{2})-([0-9]{4})%', $value);
        }

        return preg_match_all('%(?!^0+$)[a-zA-Z0-9]{6,9}%', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.regex');
    }
}
