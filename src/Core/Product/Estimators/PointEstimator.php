<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Integration;
use ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces\EstimatorInterface;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Estimation;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Point;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class PointEstimator implements EstimatorInterface
{
    const COST_PER_HOUR = 35;

    const DURATION_PER_INTEGRATION = [
        Integration::MAILGUN => 6,
        Integration::MAILCHIMP => 6,
        Integration::PAYPAL => 6,
        Integration::STRIPE => 6,
        Integration::AUTHORIZE_NET => 6,
    ];

    const DURATION_PER_CUSTOM_INTEGRATION = 16;
    const DURATION_PER_PLACE = 3;

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return bool
     */
    public function supports(Given $given, array $givens)
    {
        return $given->getFeature()->getName()->is(Name::POINT);
    }

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return Estimation
     */
    public function estimate(Given $given, array $givens)
    {
        /**
         * @var Point[] $points
         */
        $points = $given->getValue();

        $estimation = new Estimation();

        $duration = array_reduce($points, function($duration, Point $point){
            $durationPerIntegration = (self::DURATION_PER_INTEGRATION[$point->getIntegration()] ?? self::DURATION_PER_CUSTOM_INTEGRATION);
            $durationPerPlaces = self::DURATION_PER_PLACE * count($point->getPlaces());
            return $duration + $durationPerIntegration + $durationPerPlaces;
        }, 0);

        $estimation->setDuration($duration);
        $estimation->setPrice($duration * self::COST_PER_HOUR);

        return $estimation;
    }
}