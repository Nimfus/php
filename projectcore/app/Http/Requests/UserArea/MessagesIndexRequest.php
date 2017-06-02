<?php
namespace App\Http\Requests\UserArea;

use App\Http\Requests\BaseRequest;

class MessagesIndexRequest extends BaseRequest
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
            'page' => 'integer'
        ];
    }
}