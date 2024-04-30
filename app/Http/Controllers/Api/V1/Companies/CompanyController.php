<?php

namespace App\Http\Controllers\Api\V1\Companies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Company as CompanyResource;
use App\Services\Company\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(private readonly CompanyService $companyService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'min_age' => ['nullable', 'integer'],
            'max_age' => ['nullable', 'integer'],
        ]);

        $data = $this->companyService->all($request->min_age, $request->max_age);
        return $this->successResponse([
            'companies' => CompanyResource::collection($data)
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:companies,name'],
            'started_at' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'],
        ]);

        $this->companyService->add($validated['name'], $validated['started_at']);
        return $this->successResponse([],  __('messages.operation_succeeded'));
    }
}
