<?php
/**
 * Created by PhpStorm.
 * User: Osmany Torres Leyva
 * Date: 18/11/2017
 * Time: 15:31
 */

namespace CUBiM\Http\Requests;


/**
 * Class PasswordFormRequest
 * @package CUBiM\Http\Requests
 */
class PasswordFormRequest extends Request
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
            'password' => 'required',
            'new_password' => 'required|confirmed'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'password.required' => 'El campo "Contrase&ntilde;a actual" es requerido.',
            'new_password.required' => 'El campo "Nueva contrase&ntilde;a" es requerido.',
            'new_password.confirmed' => 'La "Nueva contrase&ntilde;a" y su confirmaci&oacute;n deben coincidir.'
        ];
    }
}