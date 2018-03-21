<?php

namespace Src;

class Tennis {

    private $_playerPoints = [
        0 => array('0','0'),
        1 => array('0','0')
    ];

    private $_tieBreak = false;

    /**
     * @return string
     */
    function getScore() {
        $score = 'Points: '.$this->_playerPoints[0][0].' - '.$this->_playerPoints[1][0].' / Games: '.$this->_playerPoints[0][1].' - '.$this->_playerPoints[1][1];
        if($this->_tieBreak) {
            $score .= ' / Tie Break: '.$this->_playerPoints[0][2].' - '.$this->_playerPoints[1][2];
        }
        return $score;
    }

    private function _playerScores($playerName) {
        if (  abs($this->_playerPoints[$playerName][1] - $this->_playerPoints[!$playerName][1]) >= 2
             &&  ($this->_playerPoints[$playerName][1] >= 6 || $this->_playerPoints[!$playerName][1] >= 6) ){ 
            // end of match
        } else if ( $this->_playerPoints[$playerName][1] == 6 && $this->_playerPoints[!$playerName][1] == 6 ) {
            if($this->_playerPoints[$playerName][2] < 7 && $this->_playerPoints[!$playerName][2] < 7) {
                $this->_playerPoints[$playerName][2] += 1;
            } else {
                // end of match
            }
        } else {
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
                        $this->_playerPoints[$playerName][1] += 1;
                        $this->_playerPoints[!$playerName][0] = '0';
                    }
                    break;
                case 'A':
                    $this->_playerPoints[$playerName][0] = '0';
                    $this->_playerPoints[$playerName][1] += 1;
                    $this->_playerPoints[!$playerName][0] = '0';
                    break;
            }
        }

        if ( !$this->_tieBreak && $this->_playerPoints[$playerName][1] == 6 && $this->_playerPoints[!$playerName][1] == 6 ) {
            // begin tie break
            $this->_tieBreak = true;
            array_push($this->_playerPoints[$playerName], '0');
            array_push($this->_playerPoints[!$playerName], '0');
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
