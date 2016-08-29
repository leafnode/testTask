<?php

namespace Leafnode;

class GameManager
{
    private $startTime;
    private $actionCount;
    private $board;
    private $gameStatus;

    public function __construct()
    {
        $this->startTime = time();
        $this->gameStatus = 'running';
        $this->board = new GameBoard(5, 4);

        // Filler class can be chosen from eg. configuration
        $filler = new RandomBoardFiller();
        $this->board->fill($filler);
    }

    /**
     * Perform a guess
     *
     * @param $x
     * @param $y
     * @return int
     * @throws GameException
     */
    public function guess($x, $y)
    {

        if ( !$this->board->checkBounds($x, $y) ) {
            throw new GameException("Invalid Bounds", 40);
        }

        $retval = $this->board->get($x, $y)->check();

        if ($retval === GameToken::ALREADYCHECKED) {
            throw new GameException("Token already checked", 50);
        }

        $this->actionPerformed();

        if ($retval == true) {
            $this->gameStatus = 'won';
        }

        // Pass returned value to caller
        return $retval;

    }

    /**
     * Check if game time has exceeded
     *
     * @throws GameRulesException
     */
    private function validateRunTime()
    {
        if (time() - $this->startTime > 60) {
            throw new GameException("Time limit exceeded", 10);
        }
    }

    private function actionPerformed()
    {
        $this->validateRunTime();
        $this->actionCount++;

        if ($this->actionCount > 5) {
            throw new GameException("Action count exceeded", 20);
        }
    }

}