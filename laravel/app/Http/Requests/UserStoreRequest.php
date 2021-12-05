<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Rules\PasswordRule;
use Illuminate\Support\Facades\Hash;

class UserStoreRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => ['required', Rule::unique('users')],
            'password' => ['required', new PasswordRule()],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須です。',
            'email.required' => 'Eメールは必須です。',
            'email.unique' => 'Eメールはすでに存在しています',
            'password.required' => 'パスワードは必須です。',
        ];
    }
}
