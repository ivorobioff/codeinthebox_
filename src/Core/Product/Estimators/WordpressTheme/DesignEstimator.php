<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\WordpressTheme;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Website;
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

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return bool
     */
    public function supports(Given $given, array $givens)
    {
        return $given->getFeature()->getName()->is(Name::DESIGN)
            && $this->getWebsite($givens)->is(Website::COMPANY_WEBSITE);
    }

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return Estimation
     */
    public function estimate(Given $given, array $givens)
    {
        return (new \ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\CompanyWebsite\DesignEstimator())
            ->estimate($given, $givens);
    }
}