<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsommationRequest extends FormRequest
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
        return [
            'newConsomation'=>'required|integer',
        ];
    }
    public function messages(){
        return[
            'newConsomation.required' => 'Le champ numero de contrat est obligatoire.',
            'newConsomation.integer' => 'Le champ Numero de contrat doit être un entier.',
        ];
    }
}
