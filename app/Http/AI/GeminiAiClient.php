<?php
namespace App\Http\AI;

use App\Exceptions\AiServiceException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiAiClient implements AiClientInterface
{
    public function generate(string $prompt): array
    {
        $attempts = 3;

        while ($attempts--) {
            try {
                $response = Http::timeout(60)
                    ->post(
                        "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . config('services.gemini.key'),
                        [
                            'system_instruction' => [
                                'parts' => [
                                    ['text' => 'Return ONLY valid JSON. No markdown. No explanation.'],
                                ],
                            ],
                            'contents'           => [
                                [
                                    'role'  => 'user',
                                    'parts' => [['text' => $prompt]],
                                ],
                            ],
                            'generationConfig'   => [
                                'temperature'        => 0,
                                'max_output_tokens'  => 1000,
                                'response_mime_type' => 'application/json',
                            ],
                        ]
                    );

                if ($response->failed()) {
                    Log::error('Gemini API error', [
                        'status' => $response->status(),
                        'body'   => $response->body(),
                    ]);
                    continue;
                }

                $text = $response->json('candidates.0.content.parts.0.text');

                $parsed = $this->parseJson($text);

                if ($parsed !== null) {
                    return $parsed;
                }

            } catch (\Throwable $e) {
                Log::warning('Gemini attempt failed', [
                    'error' => $e->getMessage(),
                ]);
            }
        }

        Log::critical('Gemini failed after retries');
        throw new AiServiceException('AI service temporarily unavailable');
    }

    private function parseJson(?string $text): ?array
    {
        if (! $text) {
            return null;
        }

        $clean = trim(preg_replace('/^```json|```$/', '', $text));

        $decoded = json_decode($clean, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        return $decoded;
    }

}
