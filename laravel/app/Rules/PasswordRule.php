<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordRule implements Rule
{
    /**
     * パスワードは大文字、小文字、数字をそれぞれ最低1つ以上含み、かつ8文字以上
     * （ローカルのみ6文字以上のパスワードを設定できる）
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return app()->isProduction() ? preg_match('/^.*(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/', $value) : mb_strlen($value) >= 6;
    }

    /**
     * フォームに表示するエラーメッセージを設定
     *
     * @return string
     */
    public function message(): string
    {
        return 'パスワードには大文字小文字数字をそれぞれ最低1つ以上含み、かつ8文字以上のものを設定してください。';
    }
}
