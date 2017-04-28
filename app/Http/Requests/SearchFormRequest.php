<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchFormRequest extends FormRequest
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
                    'start' => 'required',
                    'end' => 'required|after:start',
                    'location' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'start' => 'required',
                    'end' => 'required|after:start',
                    'location' => 'required',
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'start.required' => 'Start Date is required.',
            'end.required' => 'End Date is required.',
            'location.required' => 'Pick Up Address is required.',
        ];
    }
}
