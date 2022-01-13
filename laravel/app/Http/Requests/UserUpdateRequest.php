<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Rules\PasswordRule;
use Illuminate\Support\Facades\Hash;

class UserUpdateRequest extends ApiRequest
{
    /**
     * 認証関係の判定を行う場合はここに処理を記述する。
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * ユーザー管理のユーザー編集画面のバリデーションルール
     *
     * @return array
     */
    public function rules(): array
    {

        return [
            'id' => 'required',
            'name' => 'required',
            'email' => ['required', Rule::unique('App\Models\User')->ignore($this->id)],
            'password' => ['nullable', new PasswordRule()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '名前は必須です。',
            'email.required' => 'Eメールは必須です。',
            'email.unique' => '入力したEメールはすでに存在しています。',
        ];
    }

    /**
     * バリデーション通過後、パスワードがリクエストにあればハッシュ化したものをリクエストパラメータにセット
     *
     * @return array
     */
    public function passedValidation(): array
    {
        $request = $this->all();

        if ($this->filled('password')) {
            $password = Hash::make($request['password']);
            $this->merge(['password' => $password]);
        } else {
            // パスワードがNULLだとDBに保存できずエラーになるため、リクエストから削除
            unset($request['password']);
        }

        return $request;
    }
}
