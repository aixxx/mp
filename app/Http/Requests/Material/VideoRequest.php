<?php

namespace App\Http\Requests\Material;

use App\Http\Requests\Request;

/**
 * VideoRequest.
 */
class VideoRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
        ];
    }
}
