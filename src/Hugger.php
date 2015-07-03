<?php

namespace Dave1010\Hug;

use Psr\Hug\GroupHuggable;
use Psr\Hug\Huggable;

class Hugger implements Huggable, GroupHuggable
{
    /** @var \SplObjectStorage */
    private $hugMap;

    /** @var int */
    private $minHugsRequired;

    use CanGroupHug;

    /**
     * @todo inject a HugTerminationStrategy
     */
    public function __construct($minHugsRequired = 1)
    {
        $this->hugMap = new \SplObjectStorage();
        $this->minHugsRequired = $minHugsRequired;
    }

    /**
     * Hugs this object.
     *
     * All hugs are mutual. An object that is hugged MUST in turn hug the other
     * object back by calling hug() on the first parameter. All objects MUST
     * implement a mechanism to prevent an infinite loop of hugging.
     *
     * @param Huggable $friend
     *   The object that is hugging this object.
     */
    public function hug(Huggable $friend)
    {
        if ($friend === $this) {
            // weird
            throw new \Exception('Should not attempt to hug self');
        }

        if ($this->hugMap->contains($friend) && $this->minHugsRequired <= 0) {
            // no more hugs :-(
            return;
        }

        $this->minHugsRequired--;

        $this->hugMap->attach($friend);

        $friend->hug($this);
    }
}
