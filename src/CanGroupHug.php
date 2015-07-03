<?php


namespace Dave1010\Hug;

use Psr\Hug\GroupHuggable;
use Psr\Hug\Huggable;

trait CanGroupHug
{
    abstract public function hug(Huggable $friend);

    private $groupHugInitiated = false;

    /**
     * Hugs a series of huggable objects.
     *
     * When called, this object MUST invoke the hug() method of every object
     * provided. The order of the collection is not significant, and this object
     * MAY hug each of the objects in any order provided that all are hugged.
     *
     * @param $huggables
     *   An array or iterator of objects implementing the Huggable interface.
     */
    public function groupHug($huggables)
    {
        if ($this->groupHugInitiated) {
            /**
             * We're mid way through a group hug. Don't initiate a new group hug with the same group
             */
            return;
        }

        $this->groupHugInitiated = true;

        $huggablesAndSelf = array_merge($huggables, [$this]);

        foreach ($huggables as $huggable) {
            if (!$huggable instanceof Huggable) {
                throw new \InvalidArgumentException("Can only hug Huggables");
            }

            if ($huggable instanceof GroupHuggable) {
                /**
                 * Instruct $huggable to join in the whole group hug, instead of just us.
                 */
                $huggable->groupHug(array_filter($huggablesAndSelf, function($h) use ($huggable) {
                    // don't get $huggable to hug itself
                    return $h !== $huggable;
                }));
            } else {
                /**
                 * We have the ability to group hug but $huggable does not.
                 */
                $this->hug($huggable);
            }
        }

        $this->groupHugInitiated = false;
    }
}
