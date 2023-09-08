<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Facades\Telegraph;

use App\Models\Question;
use Illuminate\Support\Stringable;

class Helper
{
    public static function getAllowedCommands(){

        return config('app.tbot_allowed_commands');
    }
}
