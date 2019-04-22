<?php

namespace OrlandoLibardi\FilesCms\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OrlandoLibardi\FilesCms\app\Rules\FileExists;
use OrlandoLibardi\FilesCms\app\Rules\FolderExists;

class ImageRequest extends FormRequest
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
            case 'PUT':
                $rules = [
                    'folder'  => [new FolderExists],
                    'image'   => [new FileExists($this->folder)],        
                    'rename'  => 'required|boolean',            
                    'size.x' => 'sometimes|numeric',
                    'size.y' => 'sometimes|numeric',
                    'size.width' => 'sometimes|numeric',
                    'size.height' => 'sometimes|numeric',
                    'size.r_width' => 'sometimes|numeric',
                    'size.r_height' => 'sometimes|numeric',
                    'size.directionY' => 'sometimes',
                    'size.directionX' => 'sometimes',
                    'size.rotate' => 'sometimes|numeric'
                    ];   
            break;    
            case 'PATCH':
                $rules = [
                    'folder'    => [new FolderExists],
                    'image'     => [new FileExists($this->folder)],                
                    'new_image' => 'required',
                    ]; 
            break;
            case 'DELETE':
                $rules = [
                    'folder'    => [new FolderExists],
                    'image'     => [new FileExists($this->folder)],       
                ];
            break;
            default:
                 $rules = [];
        }

        return $rules;

    }
    
}
