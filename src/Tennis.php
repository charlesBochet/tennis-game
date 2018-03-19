<?php

namespace Src;

class Tennis {
    /**
     * string $score
     */
    private $score = '';

    /**
     * @return string
     */
    function getScore() {
        return $this->score;
    }

    function printScore() {
        echo 'Le score actuel est de : '.$this->getScore();
    }
}
