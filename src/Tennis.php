<?php

namespace Src;

class Tennis {

    private $_playerPoints = [
        0 => array('games' => array('0'), 'points' => '0'),
        1 => array('games' => array('0'), 'points' => '0')
    ];

    private $_tieBreak = false;
    private $nbOfSet;
    private $currentSet = 1;

    public function __construct($nbOfSet = 1) {
        $this->nbOfSet = $nbOfSet;
    }

    /**
     * @return string
     */
    function getScore() {

        $games = '';
        for($i = 0; $i < count($this->_playerPoints[0]['games']); $i++) {
            $games .= ' '.$this->_playerPoints[0]['games'][$i].' - '.$this->_playerPoints[1]['games'][$i];
        }
        $games = 'Games: '.trim($games);
        $points = 'Points: '.$this->_playerPoints[0]['points'].' - '.$this->_playerPoints[1]['points'];
        if($this->_tieBreak) {
            $tieBreak = 'Tie Break: '.$this->_playerPoints[0]['tie_break'].' - '.$this->_playerPoints[1]['tie_break'];
        }
        $score = $points . ' / ' . $games . (isset($tieBreak) ? ' / ' . $tieBreak : '');
        return $score;
    }

    private function _playerScores($playerName) {
        if (  abs($this->_playerPoints[$playerName]['games'][$this->currentSet - 1] - $this->_playerPoints[!$playerName]['games'][$this->currentSet - 1]) >= 2
             &&  ($this->_playerPoints[$playerName]['games'][$this->currentSet - 1] >= 6 || $this->_playerPoints[!$playerName]['games'][$this->currentSet - 1] >= 6) ){ 
            
            if($this->nbOfSet >= $this->currentSet) {

            }
            
        } else if ( $this->_playerPoints[$playerName]['games'][$this->currentSet - 1] == 6 && $this->_playerPoints[!$playerName]['games'][$this->currentSet - 1] == 6 ) {
            if($this->_playerPoints[$playerName]['tie_break'] < 7 && $this->_playerPoints[!$playerName]['tie_break'] < 7) {
                $this->_playerPoints[$playerName]['tie_break'] += 1;
                if($this->_playerPoints[$playerName]['tie_break'] === 7 ) {
                    $this->currentSet += 1;
                    array_push($this->_playerPoints[$playerName]['games'], '0');
                    array_push($this->_playerPoints[!$playerName]['games'], '0');
                    $this->_tieBreak = false;
                }
            } else {
                
            }
        } else {
            switch($this->_playerPoints[$playerName]['points']) {
                case '0':
                    $this->_playerPoints[$playerName]['points'] = '15';
                    break;
                case '15':
                    $this->_playerPoints[$playerName]['points'] = '30';
                    break;
                case '30':
                    $this->_playerPoints[$playerName]['points'] = '40';
                    break;
                case '40':
                    if($this->_playerPoints[!$playerName]['points'] === 'A') {
                        $this->_playerPoints[!$playerName]['points'] = '40';
                    } else if ($this->_playerPoints[!$playerName]['points'] === '40') {
                        $this->_playerPoints[$playerName]['points'] = 'A';
                    } else {
                        $this->_playerPoints[$playerName]['points'] = '0';
                        $this->_playerPoints[$playerName]['games'][$this->currentSet-1] += 1;
                        $this->_playerPoints[!$playerName]['points'] = '0';
                    }
                    break;
                case 'A':
                    $this->_playerPoints[$playerName]['points'] = '0';
                    $this->_playerPoints[$playerName]['games'][$this->currentSet-1] += 1;
                    $this->_playerPoints[!$playerName]['points'] = '0';
                    break;
            }
        }

        if ( !$this->_tieBreak && $this->_playerPoints[$playerName]['games'][$this->currentSet -1] == 6 && $this->_playerPoints[!$playerName]['games'][$this->currentSet -1] == 6 ) {
            // begin tie break
            $this->_tieBreak = true;
            $this->_playerPoints[$playerName]['tie_break'] = '0';
            $this->_playerPoints[!$playerName]['tie_break'] = '0';
        }

        if (  ($this->nbOfSet >= $this->currentSet) && abs($this->_playerPoints[$playerName]['games'][$this->currentSet - 1] - $this->_playerPoints[!$playerName]['games'][$this->currentSet - 1]) >= 2
             &&  ($this->_playerPoints[$playerName]['games'][$this->currentSet - 1] >= 6 || $this->_playerPoints[!$playerName]['games'][$this->currentSet - 1] >= 6) ){ 
            $this->currentSet += 1;
            array_push($this->_playerPoints[$playerName]['games'], '0');
            array_push($this->_playerPoints[!$playerName]['games'], '0');
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
