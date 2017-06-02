<?php
namespace App\Http\Requests;

class CouponStoreRequest extends BaseRequest
{
    /**
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
        return [
            'id' => 'required|string',
            'duration' => 'required|in:forever,once,repeating',
            'amount_off' => 'required_without:percent_off',
            'currency' => 'required|string|in:usd,pln',
            'duration_in_months' => 'required_if:duration,repeating|integer',
            'max_redemptions' => 'integer',
            'percent_off' => 'required_without:amount_off',
        ];
    }
}