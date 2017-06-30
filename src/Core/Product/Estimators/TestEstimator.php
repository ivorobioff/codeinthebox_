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
class TestEstimator implements EstimatorInterface
{
    use UtilsTrait;

    const COST_PER_HOUR = 35;

    const DURATION_PER_MODULE = [
        Goal::PROTOTYPE => 0.4,
        Goal::MVP => 2,
        Goal::FULLY_COMPLETED => 4
    ];

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return bool
     */
    public function supports(Given $given, array $givens)
    {
        return $given->getFeature()->getName()->is(Name::TEST);
    }

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return Estimation
     */
    public function estimate(Given $given, array $givens)
    {
        $goal = $this->getGoal($givens);
        $totalModules = $this->getTotalModules($givens);

        $estimation = new Estimation();

        $duration = (int) ceil($totalModules * self::DURATION_PER_MODULE[(string) $goal]);

        $estimation->setDuration($duration);
        $estimation->setPrice($duration * self::COST_PER_HOUR);

        return $estimation;
    }
}