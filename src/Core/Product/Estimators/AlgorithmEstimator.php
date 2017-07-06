<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Algorithm;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces\EstimatorInterface;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Estimation;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class AlgorithmEstimator implements EstimatorInterface
{
    const COST_PER_HOUR = 35;

    const DURATION = [
        Algorithm::NO => 0,
        Algorithm::PROVIDED => 8,
        Algorithm::WANTED => 20
    ];

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return bool
     */
    public function supports(Given $given, array $givens)
    {
        return $given->getFeature()->getName()->is(Name::ALGORITHM);
    }

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return Estimation
     */
    public function estimate(Given $given, array $givens)
    {
        $estimation = new Estimation();

        $duration = self::DURATION[(string) $given->getValue()];

        $estimation->setDuration($duration);
        $estimation->setPrice($duration * self::COST_PER_HOUR);

        return $estimation;
    }
}