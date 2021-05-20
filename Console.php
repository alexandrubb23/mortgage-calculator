<?php

declare(strict_types=1);

class Console
{
    public static function readNumber(string $prompt, int $min, int $max)
    {
        $value = 0;
        while (true) {
            $value = readline($prompt . " ");
            if ($value >= $min && $value <= $max)
                break;

            print("Enter a value between " . $min . " and " . $max . "\n");
        }

        return (float)$value;
    }
}
