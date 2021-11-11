<?php

namespace App\Service;

class SlugGenerator implements SlugGeneratorInterface
{
    const STRING = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

    public function generate(int $length = 5): string
    {
        return substr(str_shuffle(str_repeat(self::STRING, $length)),0, $length);
    }
}
