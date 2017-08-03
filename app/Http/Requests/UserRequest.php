<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UserRequest extends FormRequest
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
        
        $user = User::find($this->user);
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                $userType = $this->input('type');
                if ($userType == "Aluno"){
                    return [
                        'enrollment' => 'required|alpha_num|size:10|unique:users',
                        'cpf'        => 'required|cpf|formato_cpf|unique:users',
                        'first_name' => 'required|regex:/^[\pL\-]+$/u|max:50',
                        'last_name'  => 'required|regex:/^[\pL\-]+$/u|max:50',
                        'email'      => 'required|email|max:100',
                        'course'     => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                    ];
                }
                else {
                    return [
                        'enrollment' => 'required|alpha_dash|size:8|unique:users',
                        'cpf'        => 'required|cpf|formato_cpf|unique:users',
                        'first_name' => 'required|regex:/^[\pL\-]+$/u|max:50',
                        'last_name'  => 'required|regex:/^[\pL\-]+$/u|max:50',
                        'email'      => 'required|email|max:100',
                        'department' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                    ];
                }
            }
            case 'PUT':
            case 'PATCH':
            {
                if ($user->type == "Aluno") {
                    return [
                        'enrollment' => 'required|alpha_num|size:10|unique:users,enrollment,'. $user->id,
                        'cpf'        => 'required|cpf|formato_cpf|unique:users,cpf,' . $user->id,
                        'first_name' => 'required|regex:/^[\pL\-]+$/u|max:50',
                        'last_name'  => 'required|regex:/^[\pL\-]+$/u|max:50',
                        'email'      => 'required|email|max:100',
                        'course'     => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                    ];
                }
                else {
                    return [
                        'enrollment' => 'required|alpha_dash|size:8|unique:users,enrollment,'. $user->id,
                        'cpf'        => 'required|cpf|formato_cpf|unique:users,cpf,' . $user->id,
                        'first_name' => 'required|regex:/^[\pL\-]+$/u|max:50',
                        'last_name'  => 'required|regex:/^[\pL\-]+$/u|max:50',
                        'email'      => 'required|email|max:100',
                        'department' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                    ];
                }
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
            'first_name' => 'Nome',
            'last_name'  => 'Sobrenome',
            'email'      => 'E-mail',
            'course'     => 'Curso',
            'department' => 'Departamento/Setor'
        ];
    }
}
