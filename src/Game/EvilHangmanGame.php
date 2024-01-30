<?php

namespace App\Game;

use App\Interfaces\HangmanGameInterface;
use App\Interfaces\WordsChooserInterface;

class EvilHangmanGame extends BaseHangmanGame implements HangmanGameInterface
{
    private array $words;

    public function __construct(private WordsChooserInterface $wordsChooser)
    {
    }

    public function startNewGame(): void
    {
        $this->words = $this->wordsChooser->getWords();
        $this->pattern = str_repeat("_", strlen($this->words[0]));
        $this->lives = 7;
    }

    public function guessLetter(string $letter): bool
    {
        $wordsPattern = [];

        foreach ($this->words as $word) {
            $newPattern = $this->pattern;
            for ($i = 0; $i < strlen($word); $i++) {
                if ($word[$i] === $letter) {
                    $newPattern[$i] = $letter;
                }
            }

            $wordsPattern[$newPattern] ??= [];
            $wordsPattern[$newPattern][] = $word;
        }

        $previousPattern = $this->pattern;
        $patternCounts = array_map('count', $wordsPattern);
        $this->pattern = array_keys($patternCounts, max($patternCounts))[0];
        $this->words = $wordsPattern[$this->pattern];

        if ($previousPattern === $this->pattern) {
            $this->lives--;
        }

        return $previousPattern !== $this->pattern;
    }

    public function getWord(): string
    {
        return $this->words[0];
    }
}