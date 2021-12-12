<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\AdminUser;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Api\ApiController;

class AdminUserController extends ApiController
{
    /**
     * 管理者一覧
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = AdminUser::all();

        return $this->respond([
            'data' => $data,
        ]);
    }

    /**
     * 管理者登録
     *
     * @param  AdminUserStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AdminUserStoreRequest $request): JsonResponse
    {
        try {
            AdminUser::create([
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
     * 管理者編集
     *
     * @param  AdminUserUpdateRequest  $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(AdminUserUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $validated = $request->passedValidation();

            $adminUser = AdminUser::findOrFail($id);
            $adminUser->fill($validated);
            $adminUser->save();
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return $this->respond(['true']);
    }

    /**
     * 管理者削除
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $adminUser = AdminUser::findOrFail($id);
            $adminUser->delete();
        } catch (\Throwable $e) {
            return $this->respondNotFound();
        }

        return $this->respondObjectDeleted($id);
    }
}
