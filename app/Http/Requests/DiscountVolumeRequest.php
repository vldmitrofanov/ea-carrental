<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountVolumeRequest extends FormRequest
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
                    'discount_amount' => 'required',
                    'booking_duration' => 'required|numeric',
                    'description' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required',
                    'discount_amount' => 'required',
                    'booking_duration' => 'required|numeric',
                    'description' => 'required',

                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter Discount Name.',
            'discount_amount.required' => 'Please provide Discount amount.',
            'booking_duration.required' => 'Please provide Discount Condition.',
            'booking_duration.numeric' => 'Please provide valid Discount Condition.',
            'description.required' => 'Please provide offer Description.',

        ];
    }
}
