<?php

namespace App\Http\Requests;

/**
 * Class SettingStoreRequest
 *
 * @package App\Http\Requests
 */
class SettingStoreRequest extends BaseRequest
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
            'name' => 'required|string|unique:settings,name',
            'value' => 'required|string',
            'description' => 'string'
        ];
    }
}