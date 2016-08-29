<?php

namespace Leafnode;

use PHPUnit\Framework\TestCase;

class GameManagerTest extends TestCase
{
    /**
     * @expectedException \Leafnode\GameRulesException
     * @expectedExceptionCode 10
     * @group slow
     */
    public function testCheckGameTimeExceeded()
    {
        $gameManager = new GameManager();
        sleep(61);
        $gameManager->guess(1, 1);
    }

    public function testValidBoardBounds()
    {
        for ($x = 0; $x < 5; $x++) {
            for ($y = 0; $y < 4; $y++) {
                $gameManager = new GameManager(); // ominięcie limitu
                $gameManager->guess($x, $y);
                $this->assertTrue(true); // Zliczenie sprawdzonych wartości
            }
        }
    }

    /**
     * @expectedException \Leafnode\GameException
     * @expectedExceptionCode 40
     * @dataProvider invalidBoundsProvider
     * @param $x
     * @param $y
     */
    public function testInvalidBoardBounds($x, $y)
    {
        $gameManager = new GameManager();
        $gameManager->guess($x, $y);
    }

    /**
     * @expectedException \Leafnode\GameException
     * @expectedExceptionCode 20
     */
    public function testActionLimit()
    {
        $gameManager = new GameManager();
        $gameManager->guess(1,1);
        $gameManager->guess(1,2);
        $gameManager->guess(2,1);
        $gameManager->guess(2,2);
        $gameManager->guess(3,1);
        $gameManager->guess(3,2);
    }

    /**
     * @expectedException \Leafnode\GameException
     * @expectedExceptionCode 50
     */
    public function testRepeatedCheck()
    {
        $gameManager = new GameManager();
        $gameManager->guess(1,1);
        $gameManager->guess(1,1);
    }

    public function invalidBoundsProvider()
    {
        return
            [
                [ -1, -1 ],
                [ -1, 0 ],
                [ 0, -1 ],
                [ 5, 3 ],
                [ 4, 4 ],
                [ 1000, 1000 ]
            ];
    }
}