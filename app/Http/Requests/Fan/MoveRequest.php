<?php

namespace App\Http\Requests\Fan;

use App\Http\Requests\Request;

/**
 * FanGroup UpdateRequest.
 */
class MoveRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ids' => 'required',
            'to_group_id' => 'required',
        ];
    }
}
