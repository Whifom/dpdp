<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Telegram\Bot\Laravel\Facades\Telegram;
use Throwable;

class TestController extends Controller
{
    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function healthCheck(): JsonResponse
    {
        try {
            $telegram_response = Telegram::setAsyncRequest(false)->getMe();
            $botId = $telegram_response->getId();
            $firstName = $telegram_response->getFirstName();
            $username = $telegram_response->getUsername();
        } catch (Throwable) {
            throw new Exception('Problem with Telegram API.', 'health_check_crush');
        }

        return response()->json(
            [
                'telegram' => [
                    'botId' => $botId,
                    'firstName' => $firstName,
                    'username' => $username,
                ],
            ]
        );
    }
}
