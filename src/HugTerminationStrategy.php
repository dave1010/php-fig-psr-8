<?php

namespace Dave1010\Hug;

use Psr\Hug\Huggable;

interface HugTerminationStrategy
{
    /**
     * Check whether we should stop hugging a Huggable
     *
     * Note: implementations MUST be idempotent but MAY return different
     * results for the same call due to other changing state.
     *
     * @param Huggable $huggable
     * @return bool
     */
    public function shouldTerminate(Huggable $huggable);
}
