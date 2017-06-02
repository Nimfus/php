<?php
namespace App\Http\Requests;

class UserUpdateRequest extends BaseRequest
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
        return [
            'name' => 'required|string',
            'email' => 'required|unique:users,email,' . $this->route('user'),
            'role' => 'required|exists:roles,id',
            'password' => 'min:8|confirmed',
            'password_confirmation' => ''
        ];
    }
}