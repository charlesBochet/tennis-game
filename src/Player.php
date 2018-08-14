<?php

namespace Src;

class Player {
    protected $points = 0;
    protected $games = 0;
    protected $sets = 0;

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @return int
     */
    public function getGames()
    {
        return $this->games;
    }

    public function getSets()
    {
        return $this->sets;
    }

    public function playerScores()
    {

        if ($this->points === 30) {
            $this->points += 10;
            return;
        }

        if ($this->points === 40) {
            $this->points = 0;
            $this->games++;

            if ($this->games === 6) {
                $this->games = 0;
                $this->sets++;
            }

            return;
        }

        $this->points += 15;
    }
}