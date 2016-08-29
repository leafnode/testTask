<?php

namespace Leafnode;

class GameToken
{
    private $status; // checked/unchecked
    private $content; // winning/not winning

    const UNCHECKED = 2;
    const CHECKED = 3;
    const ALREADYCHECKED = 4;

    /**
     * Token constructor.
     * @param $value winning/not winning
     */
    public function __construct( $value )
    {
        $this->content = $value;
        $this->status = GameToken::UNCHECKED;
    }

    public function check()
    {
        if ($this->status == GameToken::CHECKED) {
            return GameToken::ALREADYCHECKED;
        }

        $this->status = GameToken::CHECKED;
        return $this->content;
    }
}