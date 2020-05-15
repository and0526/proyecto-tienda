<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class Datos_personaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Validaciones de los campos del formulario
            // 'name' => 'required|min:5|max:255'
            'nombre' => 'required',
            'apellido' => 'required',
            'sexo' => 'required',
            'edad'=> 'required|Integer|min:15|max:99'

        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //configurar los mensajes
            'nombre.required' => 'Ingresa tu Nombre',
            'apellido.required' => 'Ingresa tu Apellido',
            'sexo.required' => 'Ingresa tu sexo',
            'edad.max' => 'La edad debe ser mayor a 15 y menor de 99',
            'edad.min' => 'La edad ebe ser mayor a 15 y menor de 99'
        ];
    }
}
