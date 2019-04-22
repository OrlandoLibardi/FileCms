<?php

namespace OrlandoLibardi\FilesCms\app\Rules;

use Illuminate\Contracts\Validation\Rule;
use Storage;

class FileExists implements Rule
{
 
    protected  $folder;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($param)
    {
        $this->folder = $param;
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
        if(Storage::exists($this->folder . "/". $value)) return true;

        return false;
    }
    public function message()
    {
        return 'O Arquivo selecionado não existe!';
    }
}