<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use App\AdminUser;

class AdminUserUpdateRequest extends ApiRequest
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
            'email' => 'required',
            'password' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須です。',
            'email.required' => 'Eメールは必須です。',
            'password.required' => 'パスワードは必須です。',
        ];
    }

    public function validationData()
    {
        $data = $this->all();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $data;
    }
}
