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
            'registration_number.required' => 'Please provide Registration Number.',
            'location_id.required' => 'Please select Location.',
        ];
    }
}
