<?php
/**
 * Created by PhpStorm.
 * User: leafnode
 * Date: 28.08.16
 * Time: 22:29
 */

namespace Leafnode;


interface GameBoardFillerInterface
{
    /**
     * @param $width
     * @param $height
     * @return array
     */
    public function generate($width, $height);
}