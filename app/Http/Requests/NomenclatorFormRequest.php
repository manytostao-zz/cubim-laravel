<?php

namespace CUBiM\Http\Requests;

/**
 * Class NomenclatorFormRequest
 * @package CUBiM\Http\Requests
 */
class NomenclatorFormRequest extends Request
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
            'description' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'description.required' => 'El campo "Descripción" es requerido.',
        ];
    }
}
