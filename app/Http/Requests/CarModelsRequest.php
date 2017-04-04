<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarModelsRequest extends FormRequest
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
                    'make' => 'required',
                    'model' => 'required',
                    'price_per_day' => 'required|numeric',
                    'price_per_hour' => 'required|numeric',
                    'limit_mileage' => 'required|numeric',
                    'extra_mileage' => 'required|numeric',
                    'total_passengers' => 'required|numeric',
                    'total_bags' => 'required|numeric',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'type_id' => 'required',
                    'make' => 'required',
                    'model' => 'required',
                    'price_per_day' => 'required|numeric',
                    'price_per_hour' => 'required|numeric',
                    'limit_mileage' => 'required|numeric',
                    'extra_mileage' => 'required|numeric',
                    'total_passengers' => 'required|numeric',
                    'total_bags' => 'required|numeric',
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'type_id.required' => 'Please select Type (SIPP Code).',
        ];
    }
}
