<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends ApiController
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * 管理画面のユーザー一覧
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = $this->userRepository->getAll();

        return $this->respond([
            'data' => $users,
        ]);
    }

    /**
     * 管理画面のユーザー新規登録
     *
     * @param  UserStoreRequest $request
     * @return Illuminate\Http\JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery($e);
        }

        return $this->respondWithOK(['true']);
    }

    /**
     * 管理画面のユーザー編集
     *
     * @param  UserUpdateRequest $request
     * @param  string  $id
     * @return Illuminate\Http\JsonResponse
     */
    public function update(UserUpdateRequest $request, string $id): JsonResponse
    {
        try {
            $validated = $request->passedValidation();

            $user = $this->userRepository->getOneById($id);
            $user->fill($validated);
            $user->save();
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return $this->respond(['true']);
    }

    /**
     * ユーザー削除
     *
     * @param  string $id
     * @return Illuminate\Http\JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $user = $this->userRepository->getOneById($id);
            $user->delete();
        } catch (\Throwable $e) {
            return $this->respondNotFound();
        }

        return $this->respondObjectDeleted($id);
    }
}
