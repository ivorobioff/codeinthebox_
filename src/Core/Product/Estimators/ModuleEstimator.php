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

    const DURATION_PROTOTYPE = 5;
    const DURATION_MVP = 8;
    const DURATION_FULLY_COMPLETED = 10;

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

        $duration = $given->getValue() * $this->getSingleModuleDuration($givens);

        $estimation->setPrice($duration * 35);

        $estimation->setDuration($duration);

        return $estimation;
    }

    /**
     * @param array $givens
     * @return int
     */
    private function getSingleModuleDuration(array $givens)
    {
        $goal = $this->getGoal($givens);

        if ($goal->is(Goal::PROTOTYPE)){
            return self::DURATION_PROTOTYPE;
        }

        if ($goal->is(Goal::FULLY_COMPLETED)){
            return self::DURATION_FULLY_COMPLETED;
        }


        return self::DURATION_MVP;
    }
}