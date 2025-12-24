<?php
namespace App\http\Services;

use App\http\AI\AiClientInterface;

class QuizService
{
    public function __construct(private AiClientInterface $ai)
    {}

    public function generate(string $topic): array
    {
        $prompt = <<<PROMPT
                     Create 5 multiple choice questions on "{$topic}".

                     Rules:
                     - 4 options each
                     - 1 correct answer
                     - Strict JSON only

                    {
                      "questions": [
                                     {
                                        "question": "",
                                        "options": ["", "", "", ""],
                                        "correct_answer": ""
                                      }
                                    ]
                                }
                    PROMPT;

        return $this->ai->generate($prompt);
    }
}
