<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\UseCases\UserUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserUseCase $useCase
    ) {}

    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'User list',
            'data' => $this->useCase->list(),
        ]);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json([
            'message' => 'User detail',
            'data' => $this->useCase->get($id),
        ]);
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        $user = $this->useCase->create($request->all());

        return response()->json([
            'message' => 'User created',
            'data' => $user,
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $user = $this->useCase->update($id, $request->all());

        return response()->json([
            'message' => 'User updated',
            'data' => $user,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->useCase->delete($id);

        return response()->json([
            'message' => 'User deleted',
        ]);
    }
}
