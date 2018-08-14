<?php

namespace Src;

class Tennis {

    protected $playerA;
    protected $playerB;

    public function __construct()
    {
        $this->playerA = new Player();
        $this->playerB = new Player();
    }

    public function getScore()
    {
        return 'Points: '.$this->playerA->getPoints().' - '.$this->playerB->getPoints().' / Games: '.
            $this->playerA->getGames().' - '.$this->playerB->getGames() .' / Sets: '.
            $this->playerA->getSets().' - '.$this->playerB->getSets();
    }

    public function playerScores($player)
    {
        if ($player === 'A') {
            $this->playerA->playerScores();
        } elseif ($player === 'B') {
            $this->playerB->playerScores();
        } else {
            throw new \Exception('This player does not exist');
        }
    }

    public function playerScoresMultiple($player, $times)
    {
        for ($i = 0; $i < $times; $i++) {
            $this->playerScores($player);
        }
    }

}
