<?php

namespace App\Interfaces;

interface HangmanGameInterface {
    public function startNewGame(): void; // Démarre une nouvelle partie
    public function guessLetter(string $letter): bool; // Renvoie si oui ou non la lettre était présente
    public function getWordState(): string; // Renvoie le motif, style _ _ T _ _
    public function getWord(): string;
    public function getRemainingAttempts(): int; // Nombre d'essais restants, doit démarrer à 7
    public function isGameOver(): bool; // Est-ce que la partie en cours est finie ?
    public function hasPlayerWon(): bool; // Est-ce qu'un joueur a gagné ?
}