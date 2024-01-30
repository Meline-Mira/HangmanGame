<?php

namespace App\Game;

use App\Interfaces\HangmanGameInterface;
use App\Interfaces\WordChooserInterface;

class NormalHangmanGame extends BaseHangmanGame implements HangmanGameInterface
{
    private string $word;

    public function __construct(private WordChooserInterface $wordChooser)
    {
    }

    public function startNewGame(): void
    {
        $this->word = $this->wordChooser->getWord();
        $this->pattern = str_repeat("_", strlen($this->word));
        $this->lives = 7;
    }

    public function guessLetter(string $letter): bool
    {
        $letterFound = false;
        for ($i = 0; $i < strlen($this->word); $i++) {
            if ($this->word[$i] === $letter) {
                $this->pattern[$i] = $letter;
                $letterFound = true;
            }
        }

        if ($letterFound === false) {
            $this->lives--;
        }

        return $letterFound;
    }

    public function getWord(): string
    {
        return $this->word;
    }
}