<?php

namespace Leafnode;


class RandomBoardFiller implements GameBoardFillerInterface
{
    public function generate($width, $height)
    {
        $output = array();

        // Prepare a board with empty tokens
        for($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $output[$x][$y] = false;
            }
        }

        // Insert winning token at a random location
        $x = rand(0, $width - 1);
        $y = rand(0, $height - 1);
        $output[$x][$y] = true;

        return $output;
    }
}