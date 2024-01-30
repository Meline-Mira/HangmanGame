<?php

namespace App\Service;

use App\Interfaces\WordChooserInterface;

class DictionaryWordChooser implements WordChooserInterface
{
    public function __construct(public string $path) {}

    public function getWord(): string
    {
        $words = file($this->path, FILE_IGNORE_NEW_LINES);
        $rand_key = array_rand($words);
        return $words[$rand_key];
    }
}