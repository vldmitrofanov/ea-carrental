<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarExtraRequest extends FormRequest
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
                    'name' => 'required|unique:car_extras,name',
                    'price' => 'required|numeric',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|unique:car_extras,name,'.$this->id,
                    'price' => 'required|numeric',
                ];
            }
            default:break;
        }
    }

//    public function messages()
//    {
//        return [
//            'name.required' => 'Car Type is required.',
//            'name.unique' => 'Car Type is already defined.',
//        ];
//    }
}
