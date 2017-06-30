<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Design;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Goal;
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

    const HTML_COST_PER_HOUR = 20;
    const DESIGN_COST_PER_HOUR = 40;

    const HTML_DURATION_PER_MODULE = [
        Goal::PROTOTYPE => 0.6,
        Goal::MVP => 2,
        Goal::FULLY_COMPLETED => 4
    ];

    const DESIGN_DURATION_PER_MODULE = [
        Goal::PROTOTYPE => 0,
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
            $duration = $this->getHtmlDuration($givens);
            $estimation->setDuration($duration);
            $estimation->setPrice($duration * self::HTML_COST_PER_HOUR);
        }

        if ($value->is(Design::WANTED)){
            $duration = $this->getHtmlDuration($givens) + $this->getDesignDuration($givens);
            $estimation->setDuration($duration);
            $estimation->setPrice($duration * ceil((self::DESIGN_COST_PER_HOUR + self::HTML_COST_PER_HOUR) / 2));
        }

        return $estimation;
    }

    /**
     * @param Given[] $givens
     * @return int
     */
    private function getHtmlDuration(array $givens)
    {
        $totalModules = $this->getTotalModules($givens);
        $goal = $this->getGoal($givens);

        $duration = (int) ceil($totalModules * self::HTML_DURATION_PER_MODULE[(string) $goal]);

        return $duration;
    }

    /**
     * @param Given[] $givens
     * @return int
     */
    private function getDesignDuration(array $givens)
    {
        $totalModules = $this->getTotalModules($givens);
        $goal = $this->getGoal($givens);

        return $totalModules * self::DESIGN_DURATION_PER_MODULE[(string) $goal];
    }
}