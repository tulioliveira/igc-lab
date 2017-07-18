<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Student;

class StudentRequest extends FormRequest
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
        $student = Student::find($this->student);

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
                    'enrollment' => 'required|alpha_num|size:10|unique:students',
                    'cpf'        => 'required|cpf|formato_cpf|unique:students',
                    'name'       => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                    'email'      => 'required|email|max:100',
                    'course'     => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                    'zipcode'    => 'required|alpha_dash|size:9',
                    'street'     => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                    'city'       => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                    'state'      => 'required',
                    'number'     => 'required|alpha_num|max:6',
                    'complement' => 'regex:/^[a-z\d\-_\s]+$/i|max:100',
                    'phone'      => 'required|celular_com_ddd',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'enrollment' => 'required|alpha_num|size:10|unique:students,enrollment,'. $student->id,
                    'cpf'        => 'required|cpf|formato_cpf|unique:students,cpf,' . $student->id,
                    'name'       => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                    'email'      => 'required|email|max:100',
                    'course'     => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                    'zipcode'    => 'required|alpha_dash|size:9',
                    'street'     => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                    'city'       => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                    'state'      => 'required',
                    'number'     => 'required|alpha_num|max:6',
                    'complement' => 'regex:/^[a-z\d\-_\s]+$/i|max:100',
                    'phone'      => 'required|celular_com_ddd',
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
            'enrollment' => 'Matrícula',
            'cpf'        => 'CPF',
            'name'       => 'Nome Completo',
            'email'      => 'E-mail',
            'course'     => 'Curso',
            'zipcode'    => 'CEP',
            'street'     => 'Rua',
            'city'       => 'Cidade',
            'state'      => 'Estado',
            'number'     => 'Número',
            'complement' => 'Complemento',
            'phone'      => 'Celular',
        ];
    }
}
