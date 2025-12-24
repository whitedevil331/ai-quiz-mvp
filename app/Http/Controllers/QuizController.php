<?php

namespace App\Http\Controllers;

use App\http\Services\QuizService;
use Illuminate\Http\Request;
use Session;

class QuizController extends Controller
{
    public function index()
    {
        return view('quiz.index');
    }

    public function generate(Request $request, QuizService $service)
    {
        $request->validate(['topic' => 'required']);

        $quiz = $service->generate($request->topic);

        session(['quiz' => $quiz]);

        return view('quiz.attempt', compact('quiz'));
    }

    public function submit(Request $request)
    {
        $quiz = session('quiz');
        $answers = $request->input('answers', []);

        $score = 0;
        $feedback = [];

        foreach ($quiz['questions'] as $i => $q) {
            $correct = $q['correct_answer'];
            $user = $answers[$i] ?? null;

            if ($user === $correct) $score++;

            $feedback[] = [
                'question' => $q['question'],
                'correct' => $correct,
                'user' => $user,
            ];
        }

        return view('quiz.result', compact('score', 'feedback'));
    }
}
