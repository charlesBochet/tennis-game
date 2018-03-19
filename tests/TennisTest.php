<?php

namespace Tests;

include 'src/Tennis.php';

use Src\Tennis;
use PHPUnit\Framework\TestCase;

class TennisTest extends TestCase
{
    public function testEmptyScore()
    {
        $tennis = new Tennis();

        $this->assertSame('', $tennis->getScore());
    }
}