<?php

namespace App\Http\Resources\Traits;

use App\Exceptions\UserException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait OutputHelper
{
    public function response(int $code, string $message = null, mixed $data = null, array $custom = []): JsonResponse
    {
        $metaData = [
            'status' => $code,
            'message' => $message,
        ];

        $metaData = array_merge($metaData, $custom);

        return Response::json([
            'data' => $data,
            'metaData' => $metaData
        ], $code);
    }

    public function successResponse(mixed $data = null, string $message = null, array $custom = []): JsonResponse
    {
        return $this->response(ResponseAlias::HTTP_OK, $message, $data, $custom);
    }

    public function exceptionResponse(\Throwable $e): JsonResponse
    {
        if ($e instanceof UserException) {
            return $this->response($e->getCode(), $e->getMessage());
        }

        $msg = __('messages.something_went_wrong');
        return $this->response(ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, $msg, []);
    }
}
