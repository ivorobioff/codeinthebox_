<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators;

use ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces\EstimatorInterface;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class EmptyEstimator implements EstimatorInterface
{
    /**
     * @param Given $given
     * @param Given[] $givens
     * @return bool
     */
    public function supports(Given $given, array $givens)
    {
        return true;
    }

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return int
     */
    public function estimate(Given $given, array $givens)
    {
        return 0;
    }
}