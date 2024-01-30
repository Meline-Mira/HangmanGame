<?php

namespace App\Command;

use App\Interfaces\HangmanGameInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:play',
    description: 'Play the game',
)]
class PlayCommand extends Command
{
    public function __construct(private HangmanGameInterface $hangmanGame)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $this->hangmanGame->startNewGame();

        while (!$this->hangmanGame->isGameOver()) {
            $output->writeln('Word: ' . $this->hangmanGame->getWordState());
            $output->writeln('Remaining Attempts: ' . $this->hangmanGame->getRemainingAttempts());

            do {
                $question = new Question('Please enter a letter: ');
                $letter = $helper->ask($input, $output, $question);
            } while (ctype_lower($letter) === false || strlen($letter) !== 1);


            if (!$this->hangmanGame->guessLetter($letter)) {
                $output->writeln('Wrong guess!');
            }

            if ($this->hangmanGame->hasPlayerWon()) {
                $output->writeln('Congratulations, you won!');
                break;
            }
        }

        if (!$this->hangmanGame->hasPlayerWon()) {
            $output->writeln('Game Over. Better luck next time! The word was: '.$this->hangmanGame->getWord());
        }

        return Command::SUCCESS;
    }
}
