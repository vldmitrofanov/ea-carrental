<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckOutRequest extends FormRequest
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
                    'bfirst_name' => 'required',
                    'blast_name' => 'required',
                    'baddress1' => 'required',
//                    'baddress2' => 'required',
                    'bcity' => 'required',
                    'bstate' => 'required',
                    'bzip' => 'required',
                    'cc_type' => 'required',
                    'cc_number' => 'required',
                    'cc_expiration_month' => 'required',
                    'cc_expiration_year' => 'required',
                    'cc_code' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'bfirst_name' => 'required',
                    'blast_name' => 'required',
                    'baddress1' => 'required',
//                    'baddress2' => 'required',
                    'bcity' => 'required',
                    'bstate' => 'required',
                    'bzip' => 'required',
                    'cc_type' => 'required',
                    'cc_number' => 'required',
                    'cc_expiration_month' => 'required',
                    'cc_expiration_year' => 'required',
                    'cc_code' => 'required',
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'bfirst_name.required' => 'Billing First Name is required.',
            'blast_name.required' => 'Billing Last Name is required.',
            'baddress1.required' => 'Billing Address 1 is required.',
//            'baddress2.required' => 'Billing Address 2 is required.',
            'bcity.required' => 'Billing City is required.',
            'bstate.required' => 'Billing State is required.',
            'bzip.required' => 'Billing Zip is required.',
            'cc_type.required' => 'Select Credit Card Type.',
            'cc_number.required' => 'Credit Card Number is required.',
            'cc_expiration_month.required' => 'Credit Card Expiration Month is required.',
            'cc_expiration_year.required' => 'Credit Card Expiration Year is required.',
            'cc_code.required' => 'CVV Code is required.',
        ];
    }
}