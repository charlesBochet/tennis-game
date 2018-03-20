<?php

namespace Src;

class Tennis {

    private $_playerPoints = [
        0 => '0',
        1 => '0'
    ];

    /**
     * @return string
     */
    function getScore() {
        return 'Points: '.$this->_playerPoints[0].' - '.$this->_playerPoints[1].' / Games: 0 - 0';
    }

    private function _playerScores($playerName) {
        switch($this->_playerPoints[$playerName]) {
            case '0':
                $this->_playerPoints[$playerName] = '15';
                break;
            case '15':
                $this->_playerPoints[$playerName] = '30';
                break;
            case '30':
                $this->_playerPoints[$playerName] = '40';
                break;
            case '40':
                if($this->_playerPoints[!$playerName] !== '40') {
                    $this->_playerPoints[$playerName] = '0';
                    $this->_playerPoints[!$playerName] = '0';
                } else {
                    $this->_playerPoints[$playerName] = 'A';
                }
                break;
        }
    }

    function playerAScores() {
        $this->_playerScores(0);

    }

    function playerBScores() {
        $this->_playerScores(1);
    }

    /**
     * @return void
     */
    function printScore() {
        echo 'Le score actuel est de : '.$this->getScore();
    }
}
