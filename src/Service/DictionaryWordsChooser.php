<?php

namespace App\Service;

use App\Interfaces\WordsChooserInterface;

class DictionaryWordsChooser implements WordsChooserInterface
{
    public function __construct(public string $path) {}

    public function getWords(): array
    {
        $dictionary = file($this->path, FILE_IGNORE_NEW_LINES);
        $rand_int = rand(6, 10);
        $words = [];
        foreach ($dictionary as $word) {
            if (strlen($word) === $rand_int) {
                $words[] = $word;
            }
        }

        return $words;
    }
}