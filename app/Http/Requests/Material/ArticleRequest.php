<?php

namespace App\Http\Requests\Material;

use App\Http\Requests\Request;

/**
 * Article.
 */
class ArticleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'article' => 'required|array',
        ];
    }
}
