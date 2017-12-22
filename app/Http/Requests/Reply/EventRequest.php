<?php

namespace App\Http\Requests\Reply;

use App\Http\Requests\Request;
use App\Models\Reply;

/**
 * Reply EventRequest.
 */
class EventRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:follow,no-match',
            'reply_content' => 'required',
            'reply_type' => 'required|in:text,material',
        ];
    }
}
