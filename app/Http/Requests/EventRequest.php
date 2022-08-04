<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //bail on arrête de vérifier dès qu'une règle n'est pas respectée
            'titre' =>'bail|required|between:5,50',
            'message' =>'bail|required|max:250',

        ];
    }
}
