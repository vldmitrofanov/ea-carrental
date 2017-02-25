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
                    'make' => 'required',
                    'model' => 'required',
                    'registration_number' => 'required',
                    'location_id' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'make' => 'required',
                    'model' => 'required',
                    'registration_number' => 'required',
                    'location_id' => 'required'
                ];
            }
            default:break;
        }
    }

//    public function messages()
//    {
//        return [
//            'name.required' => 'Office Location name is required.',
//            'name.unique' => 'Office Location name is already defined.',
//            'country_id.required' => 'Please select Country.',
//        ];
//    }
}
