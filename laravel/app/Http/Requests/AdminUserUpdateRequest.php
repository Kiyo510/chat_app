<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Rules\PasswordRule;
use App\AdminUser;

class AdminUserUpdateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'id' => 'required',
            'name' => 'required',
            'email' => ['required', Rule::unique('App\AdminUser')->ignore($this->id)],
            'password' => new PasswordRule(),
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
}
