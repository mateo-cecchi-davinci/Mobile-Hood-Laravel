<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AspectRatio implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $ratio;

    public function __construct($ratio)
    {
        $this->ratio = $ratio;
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
        $image = getimagesize($value->getRealPath());
        $width = $image[0];
        $height = $image[1];

        $actualRatio = $width / $height;

        return abs($actualRatio - $this->ratio) == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La imagen no tiene el aspecto 1:1';
    }
}
