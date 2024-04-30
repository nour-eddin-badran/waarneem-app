<?php

namespace App\Http\Controllers\Api\V1\Importer;

use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Import\ImportRequest;
use App\Services\Importer\ImportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    public function __construct(private readonly ImportService $importService)
    {
    }

    public function store(ImportRequest $request): JsonResponse
    {
        $file = $request->file('file');
        $json = file_get_contents($file->getPathname());

        $data = json_decode($json, true);

        $validator = Validator::make($data, $request->jsonContentRules(), $request->jsonContentMessages());

        if ($validator->fails()) {
            throw new UserException($validator->errors()->first(), Response::HTTP_BAD_REQUEST);
        }

        $this->importService->store($validator->validated());

        return $this->successResponse([],  __('messages.operation_succeeded'));
    }
}
