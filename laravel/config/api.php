<?php

return [
    /*
    |--------------------------------------------------------------------------
    | タイムスタンプのフォーマットを定義
    |--------------------------------------------------------------------------
    */
    'timestamp_format' => env('API_TIMESTAMP_FORMAT', 'Y-m-d\TH:i:s\Z'),

    /*
    |--------------------------------------------------------------------------
    | 日付のフォーマットを定義
    |--------------------------------------------------------------------------
    */
    'date_timestamp_format' => env('API_DATE_TIMESTAMP_FORMAT', 'Y-m-d'),

    /*
    |--------------------------------------------------------------------------
    | APIのエラーコードを定義
    |--------------------------------------------------------------------------
    */
    'error_codes' => [
        '30' => 'パラメータのサイズが大きすぎます',
        '31' => 'リソースが見つかりません',
        '32' => 'データ保存時にバリデーションエラーが発生しました',
        '33' => 'パラメータが多すぎます',
        '34' => '試行回数が多すぎるので、リクエストを遅くしてください',
        '35' => 'このメールアドレスはすでに使われています',
        // '36' => 'You can\'t set a partner or a child to a partial contact',
        '37' => 'JSONのパースで問題が発生しました',
        '38' => '日付は未来である必要があります',
        // '39' => 'The sorting criteria is invalid',
        '40' => '無垢なクエリです',
        '41' => '無効なパラメータです',
        '42' => '未認証です',
    ],
];
