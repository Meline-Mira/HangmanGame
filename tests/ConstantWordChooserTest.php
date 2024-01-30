<?php

namespace App\Tests;

use App\Service\ConstantWordChooser;
use PHPUnit\Framework\TestCase;

class ConstantWordChooserTest extends TestCase
{
    public function testConstantWordChooser()
    {
        $word = new ConstantWordChooser('MOT');

        $this->assertSame('MOT', $word->getWord());
    }
}