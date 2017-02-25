<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarTypeAddRequest extends FormRequest
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
                    'name' => 'required|unique:car_types,name',
                    'price_per_day' => 'required|numeric',
                    'price_per_hour' => 'required|numeric',
                    'limit_mileage' => 'required|numeric',
                    'extra_mileage' => 'required|numeric',
                    'total_passengers' => 'required|numeric',
                    'total_bags' => 'required|numeric',
                    'total_doors' => 'required|numeric',
                    'transmission' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|unique:car_types,name,'.$this->get('type'),
                    'price_per_day' => 'required|numeric',
                    'price_per_hour' => 'required|numeric',
                    'limit_mileage' => 'required|numeric',
                    'extra_mileage' => 'required|numeric',
                    'total_passengers' => 'required|numeric',
                    'total_bags' => 'required|numeric',
                    'total_doors' => 'required|numeric',
                    'transmission' => 'required',
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Car Type is required.',
            'name.unique' => 'Car Type is already defined.',
        ];
    }
}
