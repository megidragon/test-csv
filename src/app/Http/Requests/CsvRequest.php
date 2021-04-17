<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // yo cambiaria como funciona mucho lo del rol dependiendo del proyecto, usando permisos en db por usuario, o gestion por temporarias o oauth sin problemas :)
        return session()->get('role') === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'csv' => 'required|file|mimes:csv,txt'
        ];
    }
}
