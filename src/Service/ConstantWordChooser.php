<?php

namespace App\Service;

use App\Interfaces\WordChooserInterface;

class ConstantWordChooser implements WordChooserInterface
{
    public function __construct(public string $word) {}

    public function getWord(): string
    {
        return $this->word;
    }
}