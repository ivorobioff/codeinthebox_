<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\Redevelopment;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Design;
use ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\UtilsTrait;
use ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces\EstimatorInterface;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Estimation;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class DesignEstimator implements EstimatorInterface
{
    use UtilsTrait;

    const HTML_COST_PER_HOUR = 20;
    const DESIGN_COST_PER_HOUR = 40;

    const HTML_DURATION_PER_MODULE = 4;
    const DESIGN_DURATION_PER_MODULE = 4;

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

        if ($value->is([Design::EXISTING, Design::ANY])){
            $estimation->setDuration(0);
            $estimation->setPrice(0);
        }

        if ($value->is(Design::PROVIDED)){
            $duration = self::HTML_DURATION_PER_MODULE * $this->countModules($givens);
            $estimation->setDuration($duration);
            $estimation->setPrice($duration * self::HTML_COST_PER_HOUR);
        }

        if ($value->is(Design::WANTED)){
            $duration = (self::HTML_DURATION_PER_MODULE + self::DESIGN_DURATION_PER_MODULE) * $this->countModules($givens);
            $estimation->setDuration($duration);
            $estimation->setPrice($duration * ceil((self::DESIGN_COST_PER_HOUR + self::HTML_COST_PER_HOUR) / 2));
        }

        return $estimation;
    }
}