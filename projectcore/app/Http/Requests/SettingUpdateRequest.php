<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 13.01.17
 * Time: 21:11
 */

namespace App\Http\Requests;


class SettingUpdateRequest extends BaseRequest
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
            'name' => 'required|string|unique:settings,name,' . $this->route('setting'),
            'value' => 'required|string',
            'description' => 'string'
        ];
    }
}