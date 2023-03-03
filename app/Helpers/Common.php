<?php

namespace App\Helpers;

use App\Core\Request\AuditableRequest;
use App\Core\Request\ListDataRequest;
use App\Core\Request\ListSearchDataRequest;
use App\Core\Request\ListSearchPageDataRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Common
{
    public static function setRuleAuthor(array $rules, AuditableRequest $auditableRequest)
    {
        return array_merge($rules, $auditableRequest->rules());
    }

    public static function setRequestAuthor(FormRequest $request, AuditableRequest $auditableRequest): void
    {
        $request->merge(['request_by' => (Auth::user()) ? Auth::user()->username : $auditableRequest->request_by]);
    }


    public static function setRuleList(array $rules, ListDataRequest $listDataRequest)
    {
        return array_merge($rules, $listDataRequest->rules());
    }

    public static function setRequestList(FormRequest $request, ListDataRequest $listDataRequest): void
    {
        $request->merge(['order_by' => ($request->has('order_by')) ? $request->input('order_by') : $listDataRequest->order_by,
            'sort' => ($request->has('sort')) ? $request->input('sort') : $listDataRequest->sort]);
    }


    public static function setRuleListSearch(array $rules, ListSearchDataRequest $listSearchDataRequest)
    {
        return array_merge($rules, $listSearchDataRequest->rules());
    }

    public static function setRequestListSearch(FormRequest $request, ListSearchDataRequest $listSearchDataRequest): void
    {
        $request->merge(['order_by' => ($request->has('order_by')) ? $request->input('order_by') : $listSearchDataRequest->order_by,
            'sort' => ($request->has('sort')) ? $request->input('sort') : $listSearchDataRequest->sort,
            'search' => ($request->has('search')) ? $request->input('search') : $listSearchDataRequest->search]);
    }


    public static function setRuleListSearchPage(array $rules, ListSearchPageDataRequest $listSearchPageDataRequest)
    {
        return array_merge($rules, $listSearchPageDataRequest->rules());
    }

    public static function setRequestListSearchPage(FormRequest $request, ListSearchPageDataRequest $listSearchPageDataRequest): void
    {
        $request->merge(['order_by' => ($request->has('order_by')) ? $request->input('order_by') : $listSearchPageDataRequest->order_by,
            'sort' => ($request->has('sort')) ? $request->input('sort') : $listSearchPageDataRequest->sort,
            'search' => ($request->has('search')) ? $request->input('search') : $listSearchPageDataRequest->search,
            'page' => ($request->has('page')) ? $request->input('page') : $listSearchPageDataRequest->page,
            'per_page' => ($request->has('per_page')) ? $request->input('per_page') : $listSearchPageDataRequest->per_page]);
    }
}
