<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountVoucherRequest extends FormRequest
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
                    'voucher_code' => 'required|alpha_num|unique:discount_vouchers,voucher_code',
                    'amount' => 'required',
                    'date_from' => 'required',
                    'date_to' => 'required|after:date_from',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'voucher_code' => 'required|alpha_num|unique:discount_vouchers,voucher_code,'.$this->get('voucher'),
                    'amount' => 'required',
                    'date_from' => 'required',
                    'date_to' => 'required|after:date_from',

                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'voucher_code.required' => 'Please enter Voucher Code.',
            'voucher_code.alpha_num' => 'Voucher Code must be of combination Alpha and Numeric values.',
            'amount.required' => 'Please provide Discount voucher amount.',

        ];
    }
}
