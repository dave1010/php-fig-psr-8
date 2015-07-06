<?php

namespace Dave1010\Hug;

use Psr\Hug\Huggable;

class HuggerTest extends \PHPUnit_Framework_TestCase
{
    public function testReciprocatesHugs()
    {
        $hugger = new Hugger();

        $mock = $this->prophesize(Huggable::class);
        $mock->hug($hugger)->shouldBeCalled();

        $hugger->hug($mock->reveal());
    }

    public function testTerminatesHugging()
    {
        $hugger1 = new Hugger();
        $hugger2 = new Hugger();

        $hugger1->hug($hugger2);

        // passing this test in less than infinite time means it's successful
        $this->assertTrue(true);
    }

    /**
     * @expectedException \Exception
     */
    public function testDoesNotHugSelf()
    {
        $hugger = new Hugger();
        $hugger->hug($hugger);
    }

    public function testAllFriendsAreHuggedBack()
    {
        $hugger = new Hugger();

        $mock1 = $this->prophesize(Huggable::class);
        $mock1->hug($hugger)->shouldBeCalled();

        $mock2 = $this->prophesize(Huggable::class);
        $mock2->hug($hugger)->shouldBeCalled();

        $hugger->hug($mock1->reveal());
        $hugger->hug($mock2->reveal());
    }

    public function testGroupHug()
    {
        $hugger = new Hugger();

        $mock1 = $this->prophesize(Huggable::class);
        $mock1->hug($hugger)->shouldBeCalled();

        $mock2 = $this->prophesize(Huggable::class);
        $mock2->hug($hugger)->shouldBeCalled();

        $friends = [$mock1->reveal(), $mock2->reveal()];

        $hugger->groupHug($friends);
    }

    public function testEpicGroupHug()
    {
        $hugger1 = new Hugger(10);
        $hugger2 = new Hugger(10);
        $hugger3 = new Hugger(10);
        $hugger4 = new Hugger(10);
        $hugger5 = new Hugger(10);

        $hugger1->groupHug([$hugger2, $hugger3, $hugger4, $hugger5]);

        $this->assertTrue(true);
    }
}
