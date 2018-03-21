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
        $this->tennis->playerAScores(3);
        $this->tennis->playerBScores(3);
        $this->tennis->playerAScores();
        $this->assertSame('Points: A - 40 / Games: 0 - 0', $this->tennis->getScore());

        $this->tennis->playerBScores();
        $this->assertSame('Points: 40 - 40 / Games: 0 - 0', $this->tennis->getScore());

        $this->tennis->playerBScores();
        $this->assertSame('Points: 40 - A / Games: 0 - 0', $this->tennis->getScore());
    }

    public function testPlayersWinGames() {
        $this->tennis->playerAScores(4);
        $this->assertSame('Points: 0 - 0 / Games: 1 - 0', $this->tennis->getScore());

        $this->tennis->playerBScores(4);
        $this->assertSame('Points: 0 - 0 / Games: 1 - 1', $this->tennis->getScore());

        $this->tennis->playerAScores(4);
        $this->assertSame('Points: 0 - 0 / Games: 2 - 1', $this->tennis->getScore());

        $this->tennis->playerBScores(4);
        $this->assertSame('Points: 0 - 0 / Games: 2 - 2', $this->tennis->getScore());

        $this->tennis->playerAScores(4);
        $this->assertSame('Points: 0 - 0 / Games: 3 - 2', $this->tennis->getScore());
    }

    public function testPlayersWinGamesAfterEquality() {
        $this->tennis->playerAScores(3);
        $this->tennis->playerBScores(3);
        $this->tennis->playerAScores(2);
        $this->assertSame('Points: 0 - 0 / Games: 1 - 0', $this->tennis->getScore());

        $this->tennis->playerAScores(3);
        $this->tennis->playerBScores(3);
        $this->tennis->playerBScores(2);
        $this->assertSame('Points: 0 - 0 / Games: 1 - 1', $this->tennis->getScore());
    }

    public function testPlayerWinSet() {
        $this->tennis->playerAScores(24);
        $this->assertSame('Points: 0 - 0 / Games: 6 - 0 0 - 0', $this->tennis->getScore());
    }

    public function testPlayerAWinSetAfterEquality() {
        $this->tennis->playerAScores(20);
        $this->tennis->playerBScores(20);
        $this->tennis->playerAScores(8);
        $this->assertSame('Points: 0 - 0 / Games: 7 - 5 0 - 0', $this->tennis->getScore());
    }

    public function testPlayerBWinSetAfterEquality() {
        $this->tennis->playerAScores(20);
        $this->tennis->playerBScores(20);
        $this->tennis->playerBScores(8);
        $this->assertSame('Points: 0 - 0 / Games: 5 - 7 0 - 0', $this->tennis->getScore());
    }

    public function testPlayersEqualityBeforeTieBreak() {
        $this->tennis->playerAScores(20);
        $this->tennis->playerBScores(20);
        $this->tennis->playerBScores(4);
        $this->tennis->playerAScores(4);
        $this->assertSame('Points: 0 - 0 / Games: 6 - 6 / Tie Break: 0 - 0', $this->tennis->getScore());
    }

    public function testTieBreak() {
        $this->tennis->playerAScores(20);
        $this->tennis->playerBScores(20);
        $this->tennis->playerBScores(4);
        $this->tennis->playerAScores(4);
        $this->tennis->playerAScores();
        $this->assertSame('Points: 0 - 0 / Games: 6 - 6 / Tie Break: 1 - 0', $this->tennis->getScore());

        $this->tennis->playerAScores(3);
        $this->assertSame('Points: 0 - 0 / Games: 6 - 6 / Tie Break: 4 - 0', $this->tennis->getScore());

        $this->tennis->playerBScores(7);
        $this->assertSame('Points: 0 - 0 / Games: 6 - 6 0 - 0', $this->tennis->getScore());
    }

    public function testPlayersScoreSecondSet() {
        $this->tennis->playerAScores(24);
        $this->assertSame('Points: 0 - 0 / Games: 6 - 0 0 - 0', $this->tennis->getScore());

        $this->tennis->playerBScores();
        $this->assertSame('Points: 0 - 15 / Games: 6 - 0 0 - 0', $this->tennis->getScore());
    }

    public function testPlayerAWinMatch() {
        $this->tennis->playerAScores(48);
        $this->assertSame('Points: 0 - 0 / Games: 6 - 0 6 - 0', $this->tennis->getScore());

        $this->tennis->playerBScores();
        $this->assertSame('Points: 0 - 0 / Games: 6 - 0 6 - 0', $this->tennis->getScore());
    }
}