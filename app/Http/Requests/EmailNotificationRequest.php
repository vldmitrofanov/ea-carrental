<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailNotificationRequest extends FormRequest
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
                    'email_body' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required',
                    'email_body' => 'required'
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Please provide Notification Email Subject.',
            'email_body.required' => 'Please provide Notification Email message.',
        ];
    }
}
