<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends FormRequest
{
    /**
     * バリデーションエラーメッセージを返却
     * Error Code = 32
     *
     * @param  Validator $validator
     * @return void
     * @throw HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        $data = [
            'error' => [
                'message' => $validator->errors()->toArray(),
                'code' => 32,
            ],
        ];

        \Log::debug($data);
        throw new HttpResponseException(response()->json($data, 422, [], JSON_UNESCAPED_UNICODE));
    }
}
