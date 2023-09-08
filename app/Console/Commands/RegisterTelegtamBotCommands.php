<?php

namespace App\Console\Commands;

use App\Telegram\Helper;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Console\Command;

class RegisterTelegtamBotCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:register-telegtam-bot-commands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register telegtam bot commands';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bot = TelegraphBot::first();

        $allowed_commands = Helper::getAllowedCommands();
        $commands = [];

        foreach ($allowed_commands as $command){
            $commands[ $command['key'] ] = $command['description'];
        }

        $bot->registerCommands($commands)->send();

//        $bot->registerCommands([
//            'questions' => 'Список запитань',
//            'test' => 'test 123',
//        ])->send();
    }
}
