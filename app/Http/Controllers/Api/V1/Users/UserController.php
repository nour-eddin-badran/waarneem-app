<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'age' => ['required', 'integer', 'min:1', 'max:99'],
            'company_id' => ['nullable', 'integer', 'exists:companies,id'],
        ]);

        $companyId = $request->input('company_id');
        $this->userService->add($validated['name'], $validated['age'], $companyId);

        return $this->successResponse([],  __('messages.operation_succeeded'));
    }
}
