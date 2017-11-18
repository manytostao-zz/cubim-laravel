<?php

namespace CUBiM\Http\Requests;

use CUBiM\Model\Customer;

/**
 * Class CustomerFormRequest
 * @package CUBiM\Http\Requests
 */
class CustomerFormRequest extends Request
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
            'name' => 'required',
            'last_name' => 'required',
            'id_card' => 'unique:customers,id_card,' . $this->input('id'),
            'email' => 'email|unique:customers,email,' . $this->input('id'),
            'library_card' => 'required_with:customer_type|empty_without:customer_type|unique_by_customer_type:customer_type,' . $this->input('id'),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El campo "Nombre(s)" es requerido.',
            'last_name.required' => 'El campo "Apellidos" es requerido.',
            'id_card.required' => 'El campo "Carnet de identidad" es requerido.',
            'id_card.unique' => 'Ya existe un usuario con ese "Carnet de identidad" asociado.',
            'id_card.id_digits' => 'El número de identidad debe tener 11 dígitos (6 en el caso de los militares).',
            'email.email' => 'El campo "Correo electrónico" no es una dirección de correo electrónico válida.',
            'email.unique' => 'Ya existe un usuario con ese "Correo electrónico" asociado.',
            'library_card.required_with' => 'El campo "Carnet de biblioteca" es requerido cuando se especifica "Tipo de usuario".',
            'library_card.unique' => 'Ya existe un usuario con ese "Carnet de biblioteca" asociado.',
            'professional_type.empty_with' => 'Debe escoger solo un tipo de carrera para el estudiante.',
            'profession.required_by_value' => 'Si el usuario no es Médico o Estomatólogo, debe escoger una Profesión.',
            'specialty.required_by_value' => 'Si el usuario posee Especialidad, debe ser Médico, Estomatólogo o Residente.',
            'library_card.unique_by_customer_type' => 'Ya existe un usuario del tipo especificado con ese "Carnet de biblioteca" asociado.',
            'library_card.empty_without' => 'No debe asociar "Carnet de biblioteca" sino ha seleccionado "Tipo de usuario".'
        ];
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('professional_type', 'empty_with:profession', function ($input) {
            return !is_null($input->student) && $input->student === 'on';
        });

        $validator->sometimes('profession', 'required_by_value:professional_type', function ($input) {
            return $input->student === 'off' || is_null($input->student);
        });

        $validator->sometimes('specialty', 'required_by_value:professional_type', function ($input) {
            return $input->student === 'off' || is_null($input->student);
        });

        $validator->sometimes('id_card', 'id_digits', function ($input) {
            return !is_null($input->id_card) && $input->id_card != '';
        });

        //Solo se puede escoger un tipo de carrera cuando el usuario es estudiante
        $validator->addImplicitExtension('empty_with', function ($attribute, $value, $parameters, $validator) {
            $other_value = array_get($validator->getData(), $parameters[0]);
            if ((!is_null($value) && $value != '')
                && (!is_null($other_value) && $other_value != '')
            ) {
                return false;
            }
            return true;
        });

        //Solo se puede escoger un tipo de carrera cuando el usuario es estudiante
        $validator->addImplicitExtension('empty_without', function ($attribute, $value, $parameters, $validator) {
            $other_value = array_get($validator->getData(), $parameters[0]);
            if ((!is_null($value) && $value != '')
                && (is_null($other_value) || $other_value == '')
            ) {
                return false;
            }
            return true;
        });

        //El carnet de identidad solo puede tener 6 o 11 digitos exclusivamente
        $validator->addImplicitExtension('id_digits', function ($attribute, $value, $parameters, $validator) {
            $out = array();
            if (((preg_match("/\d{6}/", $value, $out) !== 1) || strcasecmp($value, $out[0]) > 0) &&
                (((preg_match("/\d{11}/", $value, $out) !== 1) || strcasecmp($value, $out[0]) > 0))
            ) {
                return false;
            }
            return true;
        });

        //Si el usuario no es Médico o Estomatólogo, debe escoger una Profesión.
        //Si el usuario posee Especialidad, debe ser Médico, Estomatólogo o Residente.
        $validator->addImplicitExtension('required_by_value', function ($attribute, $value, $parameters, $validator) {
            if ($attribute == 'profession') {
                $other_value = array_get($validator->getData(), $parameters[0]);
                if ($other_value == 323 and (is_null($value) || $value == '')) {
                    return false;
                }
                return true;
            } elseif ($attribute == 'specialty') {
                $other_value = array_get($validator->getData(), $parameters[0]);
                if (!($other_value == 319 || $other_value == 320 || $other_value == 539) and (!is_null($value) and $value != '')) {
                    return false;
                }
                return true;
            }
        });

        //# de carnet de biblioteca único por tipo de usuario
        $validator->addImplicitExtension('unique_by_customer_type', function ($attribute, $value, $parameters, $validator) {
            $customer_type = array_get($validator->getData(), $parameters[0]);
            $id = $parameters[1];
//            dd($id);
            $exist = Customer::where(function ($query) use ($customer_type) {
                $query->whereHas('nomenclators', function ($query) use ($customer_type) {
                    $query->where('nomenclators.id', '=', '' . $customer_type . '');
                });
            })->where('library_card', '=', $value)->where('id', '<>', $id)->count();

            if ($exist > 0)
                return false;
            return true;
        });

        return $validator;
    }
}
