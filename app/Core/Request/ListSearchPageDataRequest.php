<?php

namespace App\Core\Request;

class ListSearchPageDataRequest extends ListSearchDataRequest
{
    public int $page = 1;

    public int $per_page = 10;

    public function rules()
    {
        return array_merge([
            'page' => ['integer', 'min:1'],
            'per_page' => ['integer', 'min:1']
        ], parent::rules());
    }
}
