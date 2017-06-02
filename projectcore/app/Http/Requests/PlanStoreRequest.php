<?php
namespace App\Http\Requests;

class PlanStoreRequest extends BaseRequest
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
            'amount' => 'required|integer|min:1',
            'currency' => 'required|string|in:usd,pln',
            'interval' => 'required|in:day,week,month,year',
            'name' => 'required|string',
            'trial_period_days' => '',
        ];
    }
}