<?php

namespace Tests;

include 'src/Tennis.php';

use Src\Tennis;
use PHPUnit\Framework\TestCase;

class TennisTest extends TestCase
{
    /**
     * @var Tennis
     */
    protected $tennis;

    protected function setUp()
    {
        $this->tennis = new Tennis();
    }

    public function testEmptyScore()
    {
        $this->assertSame('Points: 0 - 0 / Games: 0 - 0', $this->tennis->getScore());
    }

    public function testPlayerAScores()
    {
        $this->tennis->playerAScores();
        $this->assertSame('Points: 15 - 0 / Games: 0 - 0', $this->tennis->getScore());

        $this->tennis->playerAScores();
        $this->assertSame('Points: 30 - 0 / Games: 0 - 0', $this->tennis->getScore());

        $this->tennis->playerAScores();
        $this->assertSame('Points: 40 - 0 / Games: 0 - 0', $this->tennis->getScore());
    }

    public function testPlayersScores()
    {
        $this->tennis->playerAScores();
        $this->assertSame('Points: 15 - 0 / Games: 0 - 0', $this->tennis->getScore());

        $this->tennis->playerAScores();
        $this->assertSame('Points: 30 - 0 / Games: 0 - 0', $this->tennis->getScore());

        $this->tennis->playerAScores();
        $this->assertSame('Points: 40 - 0 / Games: 0 - 0', $this->tennis->getScore());

        $this->tennis->playerBScores();
        $this->assertSame('Points: 40 - 15 / Games: 0 - 0', $this->tennis->getScore());

        $this->tennis->playerBScores();
        $this->assertSame('Points: 40 - 30 / Games: 0 - 0', $this->tennis->getScore());

        $this->tennis->playerBScores();
        $this->assertSame('Points: 40 - 40 / Games: 0 - 0', $this->tennis->getScore());
    }

    public function testEqualityScores() {
        $this->tennis->playerAScores();
        $this->tennis->playerAScores();
        $this->tennis->playerAScores();
        $this->tennis->playerBScores();
        $this->tennis->playerBScores();
        $this->tennis->playerBScores();
        $this->tennis->playerAScores();
        $this->assertSame('Points: A - 40 / Games: 0 - 0', $this->tennis->getScore());
    }


}