<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypesRequest extends FormRequest
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
                    'sipp_code_one' => 'required_without_all:sipp_code_two,sipp_code_three,sipp_code_four',
//                    'sipp_code_two' => 'required_without_all:sipp_code_one,sipp_code_three,sipp_code_four',
//                    'sipp_code_three' => 'required_without_all:sipp_code_one,sipp_code_two,sipp_code_four',
//                    'sipp_code_four' => 'required_without_all:sipp_code_one,sipp_code_two,sipp_code_three',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'sipp_code_one' => 'required_without_all:sipp_code_two,sipp_code_three,sipp_code_four',
//                    'sipp_code_two' => 'required_without_all:sipp_code_one,sipp_code_three,sipp_code_four',
//                    'sipp_code_three' => 'required_without_all:sipp_code_one,sipp_code_two,sipp_code_four',
//                    'sipp_code_four' => 'required_without_all:sipp_code_one,sipp_code_two,sipp_code_three',
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'required_without_all' => 'Please define proper Type using SIPP Codes.',
        ];
    }
}
