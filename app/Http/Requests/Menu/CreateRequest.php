<?php

namespace App\Http\Requests\Menu;

use App\Http\Requests\Request;
use App\Models\Menu;

/**
 * Menu CreateRequest.
 */
class CreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'menus' => 'required',
        ];
    }
}
