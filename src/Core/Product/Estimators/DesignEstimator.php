<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Design;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces\EstimatorInterface;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Estimation;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class DesignEstimator implements EstimatorInterface
{
    use UtilsTrait;

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return bool
     */
    public function supports(Given $given, array $givens)
    {
        return $given->getFeature()->getName()->is(Name::DESIGN);
    }

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return Estimation
     */
    public function estimate(Given $given, array $givens)
    {
        $estimation = new Estimation();

        /**
         * @var Design $value
         */
        $value = $given->getValue();

        if ($value->is(Design::ANY)){
            $estimation->setDuration(0);
            $estimation->setPrice(0);
        }

        if ($value->is(Design::PROVIDED)){

            $totalModules = $this->getTotalModules($givens);

            $duration = $totalModules * 4;

            $estimation->setDuration($duration);
            $estimation->setPrice($duration * 20);
        }

        if ($value->is(Design::WANTED)){

            $totalModules = $this->getTotalModules($givens);

            $duration = $totalModules * 8; // design + html
            $estimation->setDuration($duration);
            $estimation->setPrice($duration * 30); // average of $20 (html) + $40 (design)
        }

        return $estimation;
    }
}