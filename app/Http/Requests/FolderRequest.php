<?php

namespace OrlandoLibardi\FilesCms\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OrlandoLibardi\FilesCms\app\Rules\FolderExists;

class FolderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()){
            case 'PATCH':
                $rules = [
                    'folder'     => [new FolderExists],
                    'new_folder' => 'required',
                    ]; 
            break;
            case 'DELETE':
                $rules = [
                    'folder'    => [new FolderExists]       
                ];
            break;
            default:
                 $rules = [];
        }

        return $rules;

    }
    
}
