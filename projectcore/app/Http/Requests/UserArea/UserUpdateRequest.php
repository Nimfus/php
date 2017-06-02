<?php
namespace App\Http\Requests\UserArea;

use App\Http\Requests\BaseRequest;

class UserUpdateRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'photos' => 'image'
        ];
    }
}