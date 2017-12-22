<?php

namespace App\Http\Requests\Reply;

use App\Http\Requests\Request;
use App\Models\Reply;

/**
 * Reply UpdateRequest.
 */
class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'trigger_keywords' => 'required|array',
            'trigger_type' => 'required|in:equal,contain',
            'replies' => 'required|array',
        ];
    }
}
