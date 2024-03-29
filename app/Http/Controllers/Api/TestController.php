<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Classes\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\MongoDb\Test;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
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
        } catch (Throwable $throwable) {
            Log::error(LogHelper::exceptionString($throwable));
        }

        Test::insert(
            [
                'botId' => $botId,
                'firstName' => $firstName,
                'username' => $username,]
        );

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
