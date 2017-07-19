<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Equipment;

class EquipmentRequest extends FormRequest
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
        $equip = Equipment::find($this->equipment);

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'code'        => 'required|alpha_num|unique:equipment',
                    'time'        => 'required|integer',
                    'name'        => 'required|alpha_dash|max:60',
                    'description' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'code'        => 'required|alpha_num|unique:equipment,code,' . $equip->id,
                    'time'        => 'required|integer',
                    'name'        => 'required|alpha_dash|max:60',
                    'description' => 'required',
                ];
            }
            default:break;
        }
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'code'        => 'Código',
            'time'        => 'Duração de Empréstimo',
            'name'        => 'Nome',
            'description' => 'Descrição',
        ];
    }
}
