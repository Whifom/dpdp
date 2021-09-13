<?php

Route::group(
    [
        'namespace' => 'Api',
    ],
    function () {
        Route::group(
            ['prefix' => 'test'],
            function () {
                Route::any(
                    'health-check',
                    [
                        'as' => 'health-check',
                        'uses' => 'TestController@healthCheck',
                    ]
                );
            }
        );

        Route::group(
            ['prefix' => 'telegram'],
            function () {
                Route::post(
                    config('telegram.telegram_webhooks_listener_url'),
                    [
                        'as' => 'telegram-bot-listener',
                        'uses' => 'DpDpDpUaBotController@telegramBotListener',
                    ]
                );
            }
        );
    }
);
