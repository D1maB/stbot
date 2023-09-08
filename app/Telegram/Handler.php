<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Facades\Telegraph;

use App\Models\Question;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function start(){

        $commands = Helper::getAllowedCommands();
        $text = '';

        foreach ($commands as $command){
            $text = $text . $command['command']. ' - '.$command['description']."\n";
        }

        $this->reply($text);
    }

    protected function handleUnknownCommand(Stringable $text): void{
        $value = $text->value();

        $allowed_commands = Helper::getAllowedCommands();

        $commands = [];

        foreach ($allowed_commands as $command){
            $commands[ ] = $command['key'];
        }

        if(!in_array($value, $commands)){
            Telegraph::message('Невідома команда.')->send();
            //return;
        }
    }

    public function renderQuestions(){
        $questions = Question::where('is_active', true)->orderBy('order_column')->get();

        $buttons = [];

        if(!$questions->count()){
            Telegraph::message('Записів не знайдено.')->send();
            return;
        }

        foreach ($questions as $question){
            $buttons[] = Button::make($question->question)->action('question')->param('id', $question->id);
        }

        Telegraph::message('Виберіть запитання')
            ->keyboard(Keyboard::make()->buttons($buttons))->send();
    }

    public function questions():void {

        $this->renderQuestions();
    }

    public function question(){
        $id = $this->data->get('id');

        $question = Question::find($id);

        if($question){
            $text = $question->answer;
            Telegraph::message($text)->send();

            //$this->renderQuestions();
            return;
        }

        Telegraph::message('Запис не знайдено.')->send();
    }
}
