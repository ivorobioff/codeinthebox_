<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces\EstimatorInterface;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class SpecificationEstimator implements EstimatorInterface
{
    use UtilsTrait;

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return bool
     */
    public function supports(Given $given, array $givens)
    {
        return $given->getFeature()->getName()->is(Name::SPECIFICATION);
    }

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return int
     */
    public function estimate(Given $given, array $givens)
    {
        $totalModules = $this->getTotalModules($givens);

        if ($totalModules == 0){
            return 0;
        }

        return (int) ceil($totalModules / 5) * 8;
    }
}