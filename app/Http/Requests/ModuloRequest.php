<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuloRequest extends FormRequest
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
    public function prepareForValidation(){
        if($this->nombre!=null){
            $this->merge([
                'nombre'=>strtoupper($this->nombre)
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
        if($this->method()=='PUT'){
            return [
            'nombre'=>['required', 'unique:modulos,nombre,'.$this->modulo->id],
            'horas'=>['required']      
        ];
        }else{
            return [
                'nombre'=>['required', 'unique:modulos,nombre'],
                'horas'=>['required']      
            ];
        }
        
    }
    /**
     * Get messages of validations failures rules.
     *
     * @return array
     */
    public function messages(){
        return [
            'nombre.required'=>"El campo nombre es obligatorio",
            'nombre.unique'=>"Ya existe ese modulo en el sistema",
            'horas.required'=>"El campo horas es obligatorio"
        ];

    }
}
