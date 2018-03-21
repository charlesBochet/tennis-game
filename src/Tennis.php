<?php

namespace Src;

class Tennis {

    private $_playerPoints = [
        0 => array('0','0'),
        1 => array('0','0')
    ];

    /**
     * @return string
     */
    function getScore() {
        return 'Points: '.$this->_playerPoints[0][0].' - '.$this->_playerPoints[1][0].' / Games: '.$this->_playerPoints[0][1].' - '.$this->_playerPoints[1][1];
    }

    private function _playerScores($playerName) {
        switch($this->_playerPoints[$playerName][0]) {
            case '0':
                $this->_playerPoints[$playerName][0] = '15';
                break;
            case '15':
                $this->_playerPoints[$playerName][0] = '30';
                break;
            case '30':
                $this->_playerPoints[$playerName][0] = '40';
                break;
            case '40':
                if($this->_playerPoints[!$playerName][0] === 'A') {
                    $this->_playerPoints[!$playerName][0] = '40';
                } else if ($this->_playerPoints[!$playerName][0] === '40') {
                    $this->_playerPoints[$playerName][0] = 'A';
                } else {
                    $this->_playerPoints[$playerName][0] = '0';
                    $this->_playerPoints[$playerName][1] = strval(intval($this->_playerPoints[$playerName][1])) + 1;
                    $this->_playerPoints[!$playerName][0] = '0';
                }
                break;
        }

    }

    function playerAScores($number = 1) {
        for($i = 0; $i < $number; $i++) {
            $this->_playerScores(0);
        }
    }

    function playerBScores($number = 1) {
        for($i = 0; $i < $number; $i++) {
            $this->_playerScores(1);
        }
    }

    /**
     * @return void
     */
    function printScore() {
        echo 'Le score actuel est de : '.$this->getScore();
    }
}
