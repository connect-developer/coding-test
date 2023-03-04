<?php

namespace App\Core\Request;

use Illuminate\Foundation\Http\FormRequest;

class ListDataRequest extends FormRequest
{
    public string $_order_by = "created_at";

    public string $_sort = "ASC";

    public array $_filter = [];

    public function rules()
    {
        return [
            'order_by' => ['string'],
            'sort' => ['string', 'regex:(ASC|DESC)'],
            'filter' => ['array'],
            'filter.*' => ['array']
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'order_by' => ($this->has('order_by')) ? $this->input('order_by') : $this->_order_by,
            'sort' => ($this->has('sort')) ? $this->input('sort') : $this->_sort,
            'filter' => ($this->has('filter')) ? $this->input('filter') : $this->_filter
        ]);
    }
}
