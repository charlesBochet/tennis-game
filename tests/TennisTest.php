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
    protected $tennis1;

    /**
     * @var Tennis
     */
    protected $tennis2;

    protected function setUp()
    {
        $this->tennis1 = new Tennis();
        $this->tennis2 = new Tennis(2);
    }

    public function testEmptyScore()
    {
        $this->assertSame('Points: 0 - 0 / Games: 0 - 0', $this->tennis1->getScore());
    }

    public function testPlayerAScores()
    {
        $this->tennis1->playerAScores();
        $this->assertSame('Points: 15 - 0 / Games: 0 - 0', $this->tennis1->getScore());

        $this->tennis1->playerAScores();
        $this->assertSame('Points: 30 - 0 / Games: 0 - 0', $this->tennis1->getScore());

        $this->tennis1->playerAScores();
        $this->assertSame('Points: 40 - 0 / Games: 0 - 0', $this->tennis1->getScore());
    }

    public function testPlayersScores()
    {
        $this->tennis1->playerAScores();
        $this->assertSame('Points: 15 - 0 / Games: 0 - 0', $this->tennis1->getScore());

        $this->tennis1->playerAScores();
        $this->assertSame('Points: 30 - 0 / Games: 0 - 0', $this->tennis1->getScore());

        $this->tennis1->playerAScores();
        $this->assertSame('Points: 40 - 0 / Games: 0 - 0', $this->tennis1->getScore());

        $this->tennis1->playerBScores();
        $this->assertSame('Points: 40 - 15 / Games: 0 - 0', $this->tennis1->getScore());

        $this->tennis1->playerBScores();
        $this->assertSame('Points: 40 - 30 / Games: 0 - 0', $this->tennis1->getScore());

        $this->tennis1->playerBScores();
        $this->assertSame('Points: 40 - 40 / Games: 0 - 0', $this->tennis1->getScore());
    }

    public function testEqualityScores() {
        $this->tennis1->playerAScores(3);
        $this->tennis1->playerBScores(3);
        $this->tennis1->playerAScores();
        $this->assertSame('Points: A - 40 / Games: 0 - 0', $this->tennis1->getScore());

        $this->tennis1->playerBScores();
        $this->assertSame('Points: 40 - 40 / Games: 0 - 0', $this->tennis1->getScore());

        $this->tennis1->playerBScores();
        $this->assertSame('Points: 40 - A / Games: 0 - 0', $this->tennis1->getScore());
    }

    public function testPlayersWinGames() {
        $this->tennis1->playerAScores(4);
        $this->assertSame('Points: 0 - 0 / Games: 1 - 0', $this->tennis1->getScore());

        $this->tennis1->playerBScores(4);
        $this->assertSame('Points: 0 - 0 / Games: 1 - 1', $this->tennis1->getScore());

        $this->tennis1->playerAScores(4);
        $this->assertSame('Points: 0 - 0 / Games: 2 - 1', $this->tennis1->getScore());

        $this->tennis1->playerBScores(4);
        $this->assertSame('Points: 0 - 0 / Games: 2 - 2', $this->tennis1->getScore());

        $this->tennis1->playerAScores(4);
        $this->assertSame('Points: 0 - 0 / Games: 3 - 2', $this->tennis1->getScore());
    }

    public function testPlayersWinGamesAfterEquality() {
        $this->tennis1->playerAScores(3);
        $this->tennis1->playerBScores(3);
        $this->tennis1->playerAScores(2);
        $this->assertSame('Points: 0 - 0 / Games: 1 - 0', $this->tennis1->getScore());

        $this->tennis1->playerAScores(3);
        $this->tennis1->playerBScores(3);
        $this->tennis1->playerBScores(2);
        $this->assertSame('Points: 0 - 0 / Games: 1 - 1', $this->tennis1->getScore());
    }

    public function testPlayerWinMatch1Set() {
        $this->tennis1->playerAScores(24);
        $this->assertSame('Points: 0 - 0 / Games: 6 - 0', $this->tennis1->getScore());
    }

    public function testPlayerAWinMatchAfterEquality() {
        $this->tennis1->playerAScores(20);
        $this->tennis1->playerBScores(20);
        $this->tennis1->playerAScores(8);
        $this->assertSame('Points: 0 - 0 / Games: 7 - 5', $this->tennis1->getScore());
    }

    public function testPlayerBWinMatchAfterEquality() {
        $this->tennis1->playerAScores(20);
        $this->tennis1->playerBScores(20);
        $this->tennis1->playerBScores(8);
        $this->assertSame('Points: 0 - 0 / Games: 5 - 7', $this->tennis1->getScore());
    }

    public function testPlayersEqualityBeforeTieBreak() {
        $this->tennis1->playerAScores(20);
        $this->tennis1->playerBScores(20);
        $this->tennis1->playerBScores(4);
        $this->tennis1->playerAScores(4);
        $this->assertSame('Points: 0 - 0 / Games: 6 - 6 / Tie Break: 0 - 0', $this->tennis1->getScore());
    }

    public function testTieBreak() {
        $this->tennis1->playerAScores(20);
        $this->tennis1->playerBScores(20);
        $this->tennis1->playerBScores(4);
        $this->tennis1->playerAScores(4);
        $this->tennis1->playerAScores();
        $this->assertSame('Points: 0 - 0 / Games: 6 - 6 / Tie Break: 1 - 0', $this->tennis1->getScore());

        $this->tennis1->playerAScores(3);
        $this->assertSame('Points: 0 - 0 / Games: 6 - 6 / Tie Break: 4 - 0', $this->tennis1->getScore());

        $this->tennis1->playerBScores(7);
        $this->assertSame('Points: 0 - 0 / Games: 6 - 7', $this->tennis1->getScore());
    }

    public function testPlayersScoreSecondSet() {
        $this->tennis2->playerAScores(24);
        $this->assertSame('Points: 0 - 0 / Games: 6 - 0 0 - 0', $this->tennis2->getScore());

        $this->tennis2->playerBScores();
        $this->assertSame('Points: 0 - 15 / Games: 6 - 0 0 - 0', $this->tennis2->getScore());
    }

    public function testPlayerAWinMatch() {
        $this->tennis2->playerAScores(48);
        $this->assertSame('Points: 0 - 0 / Games: 6 - 0 6 - 0', $this->tennis2->getScore());

        $this->tennis2->playerBScores();
        $this->assertSame('Points: 0 - 0 / Games: 6 - 0 6 - 0', $this->tennis2->getScore());
    }
}