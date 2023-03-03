<?php

namespace App\Http\Controllers\Api;

use App\Core\Response\BasicResponse;
use App\Core\Response\GenericListResponse;
use App\Core\Response\GenericListSearchPageResponse;
use App\Core\Response\GenericListSearchResponse;
use App\Core\Response\GenericObjectResponse;
use App\Core\Response\MetaListResponse;
use App\Core\Response\MetaPageResponse;
use App\Core\Response\MetaResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiBaseController extends Controller
{
    protected function getAllJsonResponse(BasicResponse $response): JsonResponse {
        return response()->json([
            "type" => $response->getType(),
            "code_status" => $response->getCodeStatus(),
            "messages" => $response->getMessageResponseAll()
        ], $response->getCodeStatus());
    }

    protected function getAllLatestJsonResponse(BasicResponse $response): JsonResponse {
        return response()->json([
            "type" => $response->getType(),
            "code_status" => $response->getCodeStatus(),
            "message" => $response->getMessageResponseAllLatest()
        ], $response->getCodeStatus());
    }

    protected function getSuccessJsonResponse(BasicResponse $response): JsonResponse {
        $meta = (array) new MetaResponse($response->getType(),
            $response->getCodeStatus());

        return response()->json([
            "meta" => $meta,
            "messages" => $response->getMessageResponseSuccess()
        ], $response->getCodeStatus());
    }

    protected function getSuccessLatestJsonResponse(BasicResponse $response): JsonResponse {
        $meta = (array) new MetaResponse($response->getType(),
            $response->getCodeStatus());

        return response()->json([
            "meta" => $meta,
            "message" => $response->getMessageResponseSuccessLatest()
        ], $response->getCodeStatus());
    }

    protected function getErrorJsonResponse(BasicResponse $response): JsonResponse {
        $meta = (array) new MetaResponse($response->getType(),
            $response->getCodeStatus());

        return response()->json([
            "meta" => $meta,
            "messages" => $response->getMessageResponseError()
        ], $response->getCodeStatus());
    }

    protected function getErrorLatestJsonResponse(BasicResponse $response): JsonResponse {
        $meta = (array) new MetaResponse($response->getType(),
            $response->getCodeStatus());

        return response()->json([
            "meta" => $meta,
            "message" => $response->getMessageResponseErrorLatest()
        ], $response->getCodeStatus());
    }

    protected function getInfoJsonResponse(BasicResponse $response): JsonResponse {
        $meta = (array) new MetaResponse($response->getType(),
            $response->getCodeStatus());

        return response()->json([
            "meta" => $meta,
            "messages" => $response->getMessageResponseInfo()
        ], $response->getCodeStatus());
    }

    protected function getInfoLatestJsonResponse(BasicResponse $response): JsonResponse {
        $meta = (array) new MetaResponse($response->getType(),
            $response->getCodeStatus());

        return response()->json([
            "meta" => $meta,
            "message" => $response->getMessageResponseInfoLatest()
        ], $response->getCodeStatus());
    }

    protected function getWarningJsonResponse(BasicResponse $response): JsonResponse {
        $meta = (array) new MetaResponse($response->getType(),
            $response->getCodeStatus());

        return response()->json([
            "meta" => $meta,
            "messages" => $response->getMessageResponseWarning()
        ], $response->getCodeStatus());
    }

    protected function getWarningLatestJsonResponse(BasicResponse $response): JsonResponse {
        $meta = (array) new MetaResponse($response->getType(),
            $response->getCodeStatus());

        return response()->json([
            "meta" => $meta,
            "message" => $response->getMessageResponseWarningLatest()
        ], $response->getCodeStatus());
    }

    protected function getObjectJsonResponse(GenericObjectResponse $response,
                                             ?string $resource = null,
                                             ?array $meta = null): JsonResponse {

        $metaInit = (array) new MetaResponse($response->getType(),
            $response->getCodeStatus());

        if ($meta) {
            $meta = array_merge($metaInit, $meta);
        } else {
            $meta = $metaInit;
        }

        return response()->json([
            "meta" => $meta,
            "data" => ($resource) ? new $resource($response->getDto()) : $response->getDto()
        ], $response->getCodeStatus());
    }

    protected function getListJsonResponse(GenericListResponse $response,
                                           ?string $resource = null,
                                           ?array $meta = null): JsonResponse {
        $metaInit = (array) new MetaResponse($response->getType(),
            $response->getCodeStatus());

        if ($meta) {
            $meta = array_merge($metaInit, $meta);
        } else {
            $meta = $metaInit;
        }

        return response()->json([
            "meta" => $meta,
            "datas" => ($resource) ? new $resource($response->getDtoList()) : $response->getDtoList()
        ], $response->getCodeStatus());
    }

    protected function getListSearchJsonResponse(GenericListSearchResponse $response,
                                                 ?string $resource = null,
                                                 ?array $meta = null,): JsonResponse {
        $metaInit = (array) new MetaListResponse($response->getType(),
            $response->getCodeStatus(),
            $response->getTotalCount());

        if ($meta) {
            $meta = array_merge($metaInit, $meta);
        } else {
            $meta = $metaInit;
        }

        return response()->json([
            "meta" => $meta,
            "datas" => ($resource) ? new $resource($response->getDtoListSearch()) : $response->getDtoListSearch()
        ], $response->getCodeStatus());
    }

    protected function getListSearchPageJsonResponse(GenericListSearchPageResponse $response,
                                                     ?string $resource = null,
                                                     ?array $meta = null,): JsonResponse {
        $metaInit = (array) new MetaPageResponse($response->getType(),
            $response->getCodeStatus(),
            $response->getTotalCount(),
            $response->getMeta());

        if ($meta) {
            $meta = array_merge($metaInit, $meta);
        } else {
            $meta = $metaInit;
        }

        return response()->json([
            "meta" => $meta,
            "datas" => ($resource) ? new $resource($response->getDtoListSearchPage()) : $response->getDtoListSearchPage()
        ], $response->getCodeStatus());
    }
}
