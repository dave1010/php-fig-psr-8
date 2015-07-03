<?php

namespace Dave1010\Hug;
use Psr\Hug\Huggable;

/**
 * Hugs a Huggable as soon as possible
 */
class AutoHugger extends Hugger implements Huggable
{
    public function __construct($friend)
    {
        parent::__construct();
        $this->hug($friend);
    }
}
