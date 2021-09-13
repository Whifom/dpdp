<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class DpDpDpUaBotController extends Controller
{
    public function telegramBotListener(Request $request)
    {
        $update = Telegram::commandsHandler(true);

        return response()->json(null);
    }
}
