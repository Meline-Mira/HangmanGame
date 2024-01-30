<?php

namespace App\Game;

use App\Interfaces\HangmanGameInterface;

abstract class BaseHangmanGame implements HangmanGameInterface
{
    protected string $pattern;
    protected int $lives;

    public function getWordState(): string
    {
        return $this->pattern;
    }

    public function getRemainingAttempts(): int
    {
        return $this->lives;
    }

    public function isGameOver(): bool
    {
        if ($this->lives === 0) {
            return true;
        }

        return $this->hasPlayerWon();
    }

    public function hasPlayerWon(): bool
    {
        for ($i = 0; $i < strlen($this->pattern); $i++) {
            if ($this->pattern[$i] === '_') {
                return false;
            }
        }

        return true;
    }
}
