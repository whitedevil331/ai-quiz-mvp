<?php

namespace App\http\AI;

interface AiClientInterface
{
    public function generate(string $prompt): array;
}
