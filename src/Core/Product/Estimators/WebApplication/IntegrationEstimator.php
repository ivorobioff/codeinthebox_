<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\WebApplication;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Integration;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces\EstimatorInterface;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Estimation;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class IntegrationEstimator implements EstimatorInterface
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

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return bool
     */
    public function supports(Given $given, array $givens)
    {
        return $given->getFeature()->getName()->is(Name::INTEGRATION);
    }

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return Estimation
     */
    public function estimate(Given $given, array $givens)
    {
        $integrations = $given->getValue();

        $estimation = new Estimation();

        $duration = 0;

        foreach ($integrations as $integration){
            $duration += self::DURATION_PER_INTEGRATION[$integration] ?? self::DURATION_PER_CUSTOM_INTEGRATION;
        }

        $estimation->setDuration($duration);
        $estimation->setPrice($duration * self::COST_PER_HOUR);

        return $estimation;
    }
}