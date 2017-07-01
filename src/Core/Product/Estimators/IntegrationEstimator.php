<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces\EstimatorInterface;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Estimation;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class IntegrationEstimator implements EstimatorInterface
{
    const COST_PER_INTEGRATION = 35;
    const DURATION_PER_INTEGRATION = 4;

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return bool
     */
    public function supports(Given $given, array $givens)
    {
        return $given->getFeature()->getName()->is(Name::INTEGRATION);
    }

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return Estimation
     */
    public function estimate(Given $given, array $givens)
    {
        $value = $given->getValue();

        $estimation = new Estimation();

        $duration = $value * self::DURATION_PER_INTEGRATION;

        $estimation->setDuration($duration);
        $estimation->setPrice($duration * self::COST_PER_INTEGRATION);

        return $estimation;
    }
}