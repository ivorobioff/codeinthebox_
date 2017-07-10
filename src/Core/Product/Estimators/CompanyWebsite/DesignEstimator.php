<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\CompanyWebsite;

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

    const HTML_DURATION_PER_PAGE = [
        Design::WANTED => 2,
        Design::PROVIDED => 2,
        Design::ANY => 1,
    ];

    const DESIGN_DURATION_PER_PAGE = [
        Design::WANTED => 2,
        Design::PROVIDED => 0,
        Design::ANY => 1,
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
         * @var Design $design
         */
        $design = $given->getValue();

        $pages = $this->getPages($givens);

        $htmlDuration = $pages * self::HTML_DURATION_PER_PAGE[(string) $design];
        $designDuration = $pages * self::DESIGN_DURATION_PER_PAGE[(string) $design];

        $estimation->setDuration($htmlDuration + $designDuration);

        $htmlPrice = $htmlDuration * self::HTML_COST_PER_HOUR;
        $designPrice = $designDuration * self::DESIGN_COST_PER_HOUR;

        $estimation->setPrice($htmlPrice + $designPrice);

        return $estimation;
    }
}