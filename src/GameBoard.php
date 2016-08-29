<?php

namespace Leafnode;


class GameBoard
{
    private $width;
    private $height;
    private $board;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Returns false if coordinates are invalid
     *
     * @param $x
     * @param $y
     * @return bool
     */
    public function checkBounds($x, $y)
    {
        if ($x < 0 || $x > ($this->width-1) || $y < 0 || $y > ($this->height-1)) {
            return false;
        }
        return true;
    }

    /**
     * Return value at given coordinates
     *
     * @param $x
     * @param $y
     * @return GameToken
     * @throws GameException
     */
    public function get($x, $y)
    {
        if (!is_array($this->board)) {
            throw new GameException("Board not initialized", 30);
        }
        return $this->board[$x][$y];
    }

    /**
     * Fill board with data according to strategy-chosen distribution
     *
     * @param GameBoardFillerInterface $filler
     */
    public function fill(GameBoardFillerInterface $filler)
    {
        $this->board = array();
        $input = $filler->generate($this->width, $this->height);
        for($x = 0; $x < $this->width; $x++ ) {
            for($y = 0; $y < $this->height; $y++ ) {
                $this->board[$x][$y] = new GameToken($input[$x][$y]);
            }
        }
    }

}