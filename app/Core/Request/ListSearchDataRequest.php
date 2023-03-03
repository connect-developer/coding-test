<?php

namespace App\Core\Request;

class ListSearchDataRequest extends ListDataRequest
{
    public string $search = "";

    public function rules()
    {
        return array_merge([
            'search' => ['string']
        ], parent::rules());
    }
}
