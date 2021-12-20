<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    //追加
    protected function authenticated(Request $request, $user)
    {
        return $user;
    }

    /**
     * ログイン失敗時のエラーレスポンス（もっといい書き方あるはず...）
     *
     * @param Request $request
     * @return void
     */
    public function sendFailedLoginResponse(Request $request): void
    {
        $data = [
            'error' => [
                'message' => [
                    'failed' => ['ログインに失敗しました。']
                ],
                'code' => 41,
            ],
        ];

        throw new HttpResponseException(response()->json($data, 422, [], JSON_UNESCAPED_UNICODE));
    }
}
