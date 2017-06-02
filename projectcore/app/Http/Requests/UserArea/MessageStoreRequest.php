<?php
namespace App\Http\Requests\UserArea;

use App\Http\Requests\BaseRequest;

class MessageStoreRequest extends BaseRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'recipient_id' => 'required|integer',
            'thread_id' => 'required|string',
            'message' => ''
        ];
    }
}