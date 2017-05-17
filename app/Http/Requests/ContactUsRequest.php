<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ContactUsRequest extends FormRequest
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
                    'name' => 'required',
                    'contact_number' => 'required',
                    'email' => 'required|email',
                    'message' => 'required',
                    'g-recaptcha-response' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required',
                    'contact_number' => 'required',
                    'email' => 'required|email',
                    'message' => 'required',
                    'g-recaptcha-response' => 'required',
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'name.required'             => 'Name is required',
            'contact_number.required'   => 'Contact Number is required',
            'email.required'            => 'Email is required',
            'email.email'               => 'Email is invalid',
            'recaptcha'                 => 'Wrong captcha, please try again',
        ];
    }
}
