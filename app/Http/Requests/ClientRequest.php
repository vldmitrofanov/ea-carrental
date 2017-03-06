<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
                    'title' => 'required',
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'username' => 'required|alpha_num|unique:users,username',
                    'password' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'zip' => 'required',
                    'country_id' => 'required',
                    'role_id' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => 'required',
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,'.$this->get('user'),
                    'username' => 'required|alpha_num|unique:users,username,'.$this->get('user'),
                    'phone' => 'required',
                    'address' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'zip' => 'required',
                    'country_id' => 'required',
                    'role_id' => 'required',
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'country_id.required' => 'Please select Country.',
        ];
    }
}
