<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelegramBotHandleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $questions = \App\Models\Question::where('is_active', true)->orderBy('order_column')->get();
        return $questions;
    }
}
