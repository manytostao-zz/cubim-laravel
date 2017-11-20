<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 18/11/2017
 * Time: 8:17
 */

namespace CUBiM\Http\Requests;


/**
 * Class UserFormRequest
 * @package CUBiM\Http\Requests
 */
class UserFormRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'El campo "Nombre(s)" es requerido.',
            'last_name.required' => 'El campo "Apellidos" es requerido.',
            'email.required' => 'El campo "Nombre de usuario" es requerido.',
            'password.required' => 'El campo "Contrase&ntilde;a" es requerido.'
        ];
    }
}