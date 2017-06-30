<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Goal;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces\EstimatorInterface;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Estimation;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ModuleEstimator implements EstimatorInterface
{
    use UtilsTrait;

    const DURATION_PER_MODULE = [
        Goal::PROTOTYPE => 5,
        Goal::MVP => 8,
        Goal::FULLY_COMPLETED => 10
    ];

    const COST_PER_HOUR = 35;

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return bool
     */
    public function supports(Given $given, array $givens)
    {
        return $given->getFeature()->getName()->is(Name::MODULE);
    }

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return Estimation
     */
    public function estimate(Given $given, array $givens)
    {
        $estimation = new Estimation();

        $duration = $given->getValue() * self::DURATION_PER_MODULE[(string) $this->getGoal($givens)];

        $estimation->setPrice($duration * self::COST_PER_HOUR);

        $estimation->setDuration($duration);

        return $estimation;
    }
}