<?php

namespace OrlandoLibardi\FilesCms\app\Rules;

use Illuminate\Contracts\Validation\Rule;
use Storage;

class FolderExists implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        
        if($value == "" || is_null($value)) return false;

        if(!Storage::exists($value)) return false;

        return true;

    }
    public function message()
    {
        return 'A pasta selecionada não existe!';
    }
}