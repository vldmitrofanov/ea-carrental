<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
                    'status' => 'required',
                    'date_from' => 'required',
                    'date_to' => 'required',
                    'car_type_id' => 'required',
                    'car_id' => 'required',
                    'pickup_location_id' => 'required',
                    'return_location_id' => 'required',
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'address' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'country_id' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'status' => 'required',
                    'date_from' => 'required',
                    'date_to' => 'required',
                    'car_type_id' => 'required',
                    'car_id' => 'required',
                    'pickup_location_id' => 'required',
                    'return_location_id' => 'required',
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'address' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'country_id' => 'required',
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'car_type_id.required' => 'Please Select Car Type.',
            'car_id.required' => 'Please select Car.',
            'pickup_location_id.required' => 'Please select Pick-up Lcoation.',
            'return_location_id.required' => 'Please select Pick-up Lcoation.',
            'name.required' => 'Please provide Customer Name.',
            'email.required' => 'Please provide Customer Email.',
            'phone.required' => 'Please provide Customer Phone.',
            'address.required' => 'Please provide Customer Address.',
            'state.required' => 'Please provide Customer State.',
            'city.required' => 'Please provide Customer City.',
            'country_id.required' => 'Please provide Customer Country.',
        ];
    }
}
