<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartStepOneRequest extends FormRequest
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
                    'car_id' => 'required',
                    'name' => 'required',
                    'sur_name' => 'required',
                    'passport_no' => 'required',
//                    'email' => 'required|email|unique:users,email',
                    'mobile_no' => 'required',
                    'pick_up' => 'required',
                    'return' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => 'required',
                    'name' => 'required',
//                    'email' => 'required|email|unique:users,email,'.$this->get('user'),
//                    'username' => 'required|alpha_num|unique:users,username,'.$this->get('user'),
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
            'car_id.required' => 'Please select Car to continue.',
            'name.required' => 'Please provide First name.',
            'sur_name.required' => 'Please provide Sur name.',
            'passport_no.required' => 'Please provide IC/Passport Number.',
            'email.required' => 'Please provide Email.',
            'mobile_no.required' => 'Please provide Mobile No.',
            'pick_up.required' => 'Please select Pick Up Location.',
            'return.required' => 'Please select Return Location.',
        ];
    }
}