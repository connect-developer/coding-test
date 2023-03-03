<?php

namespace App\Core\Request;

class ListDataRequest
{
    public string $order_by = "created_at";

    public string $sort = "ASC";

    public function rules()
    {
        return [
            'order_by' => ['string'],
            'sort' => ['string', 'regex:(ASC|DESC)']
        ];
    }
}
