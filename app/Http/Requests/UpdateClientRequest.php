<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'raisonSocial' => 'required',
            // 'slug' => 'required',
            'adresse' => 'required',
            'complAdresse' => 'required',
            'codePostal' => 'required',
            'ville' => 'required',
            'pays' => 'required',
            'telephone' => 'required',
            'name' => 'required',
            'firstname' => 'required',
            'email' => 'required',
            // 'password' => 'required',
        ];
    }
}
