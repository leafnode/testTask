<?php
/**
 * Created by PhpStorm.
 * User: leafnode
 * Date: 28.08.16
 * Time: 23:38
 */

namespace Leafnode;

use PHPUnit\Framework\TestCase;

class GameTokenTest extends TestCase
{
    public function testTokenValue()
    {
        $token = new GameToken(true);
        $retval = $token->check();
        $this->assertEquals(true, $retval);

        $token = new GameToken(false);
        $retval = $token->check();
        $this->assertEquals(false, $retval);

    }

    public function testStatusChange()
    {
        $token = new GameToken(true);
        $retval = $token->check();
        $retval = $token->check();
        $this->assertEquals(GameToken::ALREADYCHECKED, $retval);

    }
}