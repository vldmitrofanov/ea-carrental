<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalCarRequest extends FormRequest
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
                    'type_id' => 'required',
                    'model_id' => 'required',
                    'url_token' => 'required|regex:/(^[A-Za-z0-9-]+$)+/|unique:rental_cars,url_token',
                    'registration_number' => 'required',
                    'location_id' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'type_id' => 'required',
                    'model_id' => 'required',
                    'url_token' => 'required|regex:/(^[A-Za-z0-9-]+$)+/|unique:rental_cars,url_token,'.$this->get('car'),
                    'registration_number' => 'required',
                    'location_id' => 'required'
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'type_id.required' => 'Please select Type.',
            'model_id.required' => 'Please select Make & Model.',
            'url_token.required' => 'Please provide URL Token.',
            'url_token.regex' => 'URL Token must have alpha numberic and dashes only.',
            'registration_number.required' => 'Please provide Registration Number.',
            'location_id.required' => 'Please select Location.',
        ];
    }
}
