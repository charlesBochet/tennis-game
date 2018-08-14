<?php

namespace Tests;

include 'src/Tennis.php';
include 'src/Player.php';

use Src\Tennis;
use PHPUnit\Framework\TestCase;

class TennisTest extends TestCase
{
    /**
     * @var Tennis
     */
    protected $tennis;

    public function setUp() {
        $this->tennis = new Tennis();
    }

    public function testEmptyScore()
    {
        $this->assertSame('Points: 0 - 0 / Games: 0 - 0 / Sets: 0 - 0', $this->tennis->getScore());
    }

    public function testPlayerAScores()
    {
        $this->tennis->playerScores('A');
        $this->assertSame('Points: 15 - 0 / Games: 0 - 0 / Sets: 0 - 0', $this->tennis->getScore());
    }

    public function testPlayerAScores3Times()
    {
        $this->tennis->playerScoresMultiple('A', 3);
        $this->assertSame('Points: 40 - 0 / Games: 0 - 0 / Sets: 0 - 0', $this->tennis->getScore());
    }

    public function testPlayerAScoresAGame()
    {
        $this->tennis->playerScoresMultiple('A', 4);
        $this->assertSame('Points: 0 - 0 / Games: 1 - 0 / Sets: 0 - 0', $this->tennis->getScore());
    }

    public function testPlayersABScore()
    {
        $this->tennis->playerScoresMultiple('A', 2);
        $this->tennis->playerScoresMultiple('B', 3);
        $this->assertSame('Points: 30 - 40 / Games: 0 - 0 / Sets: 0 - 0', $this->tennis->getScore());

    }

    public function testPlayersBWinAGame()
    {
        $this->tennis->playerScoresMultiple('A', 5);
        $this->tennis->playerScoresMultiple('B', 4);
        $this->assertSame('Points: 15 - 0 / Games: 1 - 1 / Sets: 0 - 0', $this->tennis->getScore());

    }

    public function testPlayersAWinASet()
    {
        $this->tennis->playerScoresMultiple('A', 20);
        $this->tennis->playerScoresMultiple('B', 4);
        $this->tennis->playerScoresMultiple('A', 4);
        $this->assertSame('Points: 0 - 0 / Games: 0 - 1 / Sets: 1 - 0', $this->tennis->getScore());

    }
}