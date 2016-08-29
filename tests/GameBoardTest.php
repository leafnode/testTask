<?php
/**
 * Created by PhpStorm.
 * User: leafnode
 * Date: 28.08.16
 * Time: 22:05
 */

namespace Leafnode;

use PHPUnit\Framework\TestCase;
use Prophecy\Exception\Exception;

class GameBoardTest extends TestCase
{

    /**
     * @expectedException \Leafnode\GameException
     * @expectedExceptionCode 30
     */
    public function testUninitializedBoardException()
    {
        $board = new GameBoard(10, 10);
        $board->get(1, 1);
    }

    public function testTokenValue()
    {
        $board = new GameBoard(10,10);
        $board->fill(new class implements GameBoardFillerInterface {
                public function generate($width, $height)
                {
                    $ret = array();
                    for($x = 0; $x < $width; $x++) {
                        $ret[$x] = array_fill(0, $width, false);
                    }
                    $ret[0][0] = true;
                    return $ret;
                }
            }
        );

        $v = $board->get(0,0)->check();
        $this->assertEquals(true, $v);
        $v = $board->get(1,1)->check();
        $this->assertEquals(false, $v);
    }
}