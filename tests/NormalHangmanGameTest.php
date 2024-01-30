<?php

namespace App\Tests;

use App\Service\ConstantWordChooser;
use PHPUnit\Framework\TestCase;
use App\Game\NormalHangmanGame;

class NormalHangmanGameTest extends TestCase
{
    public function testNormalHangmanGameLoose()
    {
        $game = new NormalHangmanGame(new ConstantWordChooser('MAMAN'));

        $game->startNewGame();

        $this->assertSame('_____', $game->getWordState());
        $this->assertSame(7, $game->getRemainingAttempts());

        $this->assertSame(true, $game->guessLetter('M'));
        $this->assertSame(7, $game->getRemainingAttempts());
        $this->assertSame('M_M__', $game->getWordState());
        $this->assertSame(false, $game->isGameOver());
        $this->assertSame(false, $game->hasPlayerWon());

        $this->assertSame(false, $game->guessLetter('B'));
        $this->assertSame(6, $game->getRemainingAttempts());
        $this->assertSame('M_M__', $game->getWordState());
        $this->assertSame(false, $game->isGameOver());
        $this->assertSame(false, $game->hasPlayerWon());

        $this->assertSame(false, $game->guessLetter('C'));
        $this->assertSame(5, $game->getRemainingAttempts());
        $this->assertSame('M_M__', $game->getWordState());
        $this->assertSame(false, $game->isGameOver());
        $this->assertSame(false, $game->hasPlayerWon());

        $this->assertSame(false, $game->guessLetter('D'));
        $this->assertSame(4, $game->getRemainingAttempts());
        $this->assertSame('M_M__', $game->getWordState());
        $this->assertSame(false, $game->isGameOver());
        $this->assertSame(false, $game->hasPlayerWon());

        $this->assertSame(false, $game->guessLetter('E'));
        $this->assertSame(3, $game->getRemainingAttempts());
        $this->assertSame('M_M__', $game->getWordState());
        $this->assertSame(false, $game->isGameOver());
        $this->assertSame(false, $game->hasPlayerWon());

        $this->assertSame(false, $game->guessLetter('F'));
        $this->assertSame(2, $game->getRemainingAttempts());
        $this->assertSame('M_M__', $game->getWordState());
        $this->assertSame(false, $game->isGameOver());
        $this->assertSame(false, $game->hasPlayerWon());

        $this->assertSame(false, $game->guessLetter('G'));
        $this->assertSame(1, $game->getRemainingAttempts());
        $this->assertSame('M_M__', $game->getWordState());
        $this->assertSame(false, $game->isGameOver());
        $this->assertSame(false, $game->hasPlayerWon());

        $this->assertSame(false, $game->guessLetter('H'));
        $this->assertSame(0, $game->getRemainingAttempts());
        $this->assertSame('M_M__', $game->getWordState());
        $this->assertSame(true, $game->isGameOver());
        $this->assertSame(false, $game->hasPlayerWon());
    }

    public function testNormalHangmanGameWin()
    {
        $game = new NormalHangmanGame(new ConstantWordChooser('MAMAN'));

        $game->startNewGame();

        $this->assertSame('_____', $game->getWordState());
        $this->assertSame(7, $game->getRemainingAttempts());

        $this->assertSame(true, $game->guessLetter('M'));
        $this->assertSame(7, $game->getRemainingAttempts());
        $this->assertSame('M_M__', $game->getWordState());
        $this->assertSame(false, $game->isGameOver());
        $this->assertSame(false, $game->hasPlayerWon());

        $this->assertSame(true, $game->guessLetter('A'));
        $this->assertSame(7, $game->getRemainingAttempts());
        $this->assertSame('MAMA_', $game->getWordState());
        $this->assertSame(false, $game->isGameOver());
        $this->assertSame(false, $game->hasPlayerWon());

        $this->assertSame(true, $game->guessLetter('N'));
        $this->assertSame(7, $game->getRemainingAttempts());
        $this->assertSame('MAMAN', $game->getWordState());
        $this->assertSame(true, $game->isGameOver());
        $this->assertSame(true, $game->hasPlayerWon());
    }
}