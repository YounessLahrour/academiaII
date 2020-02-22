<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumnoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//dar permiso
    }
    public function prepareForValidation(){
        if($this->nombre!=null){
            $this->merge([
                'nombre'=>ucwords($this->nombre)
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=>['required'],
            'apellido'=>['required'],
            'mail'=>['required', 'unique:alumnos,mail'],
            'logo'=>['nullable','image']
        ];
    }
    /**
     * Get messages of validations failures rules.
     *
     * @return array
     */
    public function messages(){
        return [
            'nombre.required'=>"El campo nombre es obligatorio",
            'apellido.required'=>"El campo apellido es obligatorio",
            'mail.required'=>"El campo mail es obligatorio",
            'mail.unique'=>"Ya existe ese mail en el sistema",
            'logo.image'=>"El fichero tiene que ser de tipo imagen"
        ];

    }
}
