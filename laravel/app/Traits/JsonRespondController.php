<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

/**
 * Json返却時に使うメソッドを定義
 */
trait JsonRespondController
{
    /**
     * @var int
     */
    protected $httpStatusCode = 200;

    /**
     * @var int
     */
    protected $errorCode;

    /**
     * HTTPステータスコードを取得
     *
     * @return int
     */
    public function getHTTPStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    /**
     * HTTPステータスコードをセット
     *
     * @param  int $statusCode
     * @return self
     */
    public function setHTTPStatusCode($statusCode): self
    {
        $this->httpStatusCode = $statusCode;

        return $this;
    }

    /**
     * エラーコードを取得
     *
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * レスポンスのエラーコードをセット
     *
     * @param  int $errorCode
     * @return self
     */
    public function setErrorCode(int $errorCode): self
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * not found (404) レスポンスを送信
     * Error Code = 31
     *
     * @return JsonResponse
     */
    public function respondNotFound(): JsonResponse
    {
        return $this->setHTTPStatusCode(404)
            ->setErrorCode(31)
            ->respondWithError();
    }

    /**
     * バリデーションエラーを送信
     * Error Code = 32.
     *
     * @param  Validator  $validator
     * @return JsonResponse
     */
    public function respondValidatorFailed(Validator $validator): JsonResponse
    {
        return $this->setHTTPStatusCode(422)
            ->setErrorCode(32)
            ->respondWithError($validator->errors()->all());
    }

    /**
     * invalid query (http 500) エラーを送信
     * Error Code = 40.
     *
     * @param  string  $message
     * @return JsonResponse
     */
    public function respondInvalidQuery($message = null)
    {
        return $this->setHTTPStatusCode(500)
            ->setErrorCode(40)
            ->respondWithError($message);
    }

    /**
     * JSONを送信
     *
     * @param  array $data
     * @return JsonResponse
     */
    public function respondWithOK(array $data)
    {
        return $this->setHTTPStatusCode(200)
            ->respond($data);
    }

    /**
     * JSONを送信
     *
     * @param  array  $data
     * @param  array  $headers  [description]
     * @return JsonResponse
     */
    public function respond($data, $headers = []): JsonResponse
    {
        return response()->json($data, $this->getHTTPStatusCode(), $headers);
    }

    /**
     * JSONのエラーレスポンスを返却
     *
     * @param  string|array  $message
     * @return JsonResponse
     */
    public function respondWithError($message = null): JsonResponse
    {
        return $this->respond([
            'error' => [
                'message' => $message ?? config('api.error_codes.' . $this->getErrorCode()),
                'error_code' => $this->getErrorCode(),
            ],
        ]);
    }
}
