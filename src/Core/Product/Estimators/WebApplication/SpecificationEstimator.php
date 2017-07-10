<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\WebApplication;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\UtilsTrait;
use ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces\EstimatorInterface;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Estimation;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class SpecificationEstimator implements EstimatorInterface
{
    use UtilsTrait;

    const COST_PER_HOUR = 35;
    const DURATION_PER_MODULE = 1.6;

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
     * @param array $givens
     * @return Estimation
     */
    public function estimate(Given $given, array $givens)
    {
        $duration = $this->getDuration($given, $givens);

        $estimation = new Estimation();

        $estimation->setPrice($duration * self::COST_PER_HOUR);
        $estimation->setDuration($duration);

        return $estimation;
    }

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return int
     */
    private function getDuration(Given $given, array $givens)
    {
        if ($given->getValue()){
            return 0;
        }

        $totalModules = $this->countModules($givens);

        if ($totalModules == 0){
            return 0;
        }

        return (int) ceil($totalModules * self::DURATION_PER_MODULE);
    }
}