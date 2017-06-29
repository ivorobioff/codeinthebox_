<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\Fixture\Support;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class Fixture extends AbstractFixture implements OrderedFixtureInterface
{
    private $order;

    /**
     * @param int $order
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }
}