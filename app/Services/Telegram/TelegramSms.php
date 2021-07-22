<?php
namespace App\Services\Telegram;

use App\Models\User\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramSms {
    public function sendRequest (User $user, string $content, string $action){

        $response = Http::post(config('app.bot_url'). '/notification/telegram', [
            'user_id' => $user->id,
            'content' => $content,
            'attachment' => [
                // 'cover' => [
                //     'url' => 'https://app.zrobleno.com.ua/storage/users/7/A06jMytG07_1611730015.png'
                // ],
                "buttons" => [
                    [
                        "name" => "Переглянути",
                        "url" => $action
                    ]
                ]
            ]
        ]);
    }
}
