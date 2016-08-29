<?php
/**
 * Created by PhpStorm.
 * User: leafnode
 * Date: 28.08.16
 * Time: 23:00
 */

namespace Leafnode;

use PHPUnit\Framework\TestCase;

class RandomBoardFillerTest extends TestCase
{
    public function testDimensionOutput()
    {
        $width = 5;
        $height = 10;

        $filler = new RandomBoardFiller();
        $arr = $filler->generate($width, $height);

        $outputWidth = count($arr);
        $this->assertEquals($width, $outputWidth);

        $outputHeight = count($arr[0]);
        $this->assertEquals($height, $outputHeight);

    }

    /**
     * Check if there's only one winning token in the output
     */
    public function testIfSingleWinningToken()
    {
        $width = 5;
        $height = 10;

        $filler = new RandomBoardFiller();
        $output = $filler->generate($width, $height);

        $sum = 0;
        $it = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($output));
        foreach ($it as $v) { $sum += $v; }
        $this->assertEquals(1, $sum);
    }
}