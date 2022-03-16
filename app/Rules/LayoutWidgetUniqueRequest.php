<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use IlluminateValidationRule;

class LayoutWidgetUniqueRequest implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
       return ['attributeName' => 'unique_multiple:layout_widgets,$value[layout_id],$value[widget_id],$value[widget_space_id]'];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ['unique_multiple' => 'This combination already exists.'];
    }
}
