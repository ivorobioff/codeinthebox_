<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\Redevelopment;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Age;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Developer;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Support;
use ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces\EstimatorInterface;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Estimation;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ModuleEstimator implements EstimatorInterface
{
    const DURATION_PER_MODULE = [
        Developer::COMPANY => 16,
        Developer::FREELANCER => 24
    ];

    const PERCENTAGE_AGE = [
        Age::NORMAL => 0,
        Age::VERY_OLD => 50,
        Age::OLD => 30
    ];

    const PERCENTAGE_SUPPORT = [
        Support::SAME_PARTIES => 0,
        Support::OTHER_PARTIES => 50
    ];

    const PERCENTAGE_NO_MANUAL = 50;

    const COST_PER_HOUR = 35;

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return bool
     */
    public function supports(Given $given, array $givens)
    {
        return $given->getFeature()->getName()->is(Name::MODULE);
    }

    /**
     * @param Given $given
     * @param Given[] $givens
     * @return Estimation
     */
    public function estimate(Given $given, array $givens)
    {
        $estimation = new Estimation();

        $duration = count($given->getValue()) * $this->getDurationPerModule($givens);

        $estimation->setDuration($duration);
        $estimation->setPrice($duration * self::COST_PER_HOUR);

        return $estimation;
    }

    /**
     * @param Given[] $givens
     * @return int
     */
    private function getDurationPerModule(array $givens)
    {
        $developer = $this->getDeveloper($givens);
        $age = $this->getAge($givens);
        $support = $this->getSupport($givens);
        $hasManual = $this->hasManual($givens);

        $duration = self::DURATION_PER_MODULE[(string) $developer];

        $durationPerAge = ceil(($duration * self::PERCENTAGE_AGE[(string) $age])/100);

        $durationPerSupport = ceil(($duration * self::PERCENTAGE_SUPPORT[(string) $support])/100);

        $durationWhenNoManual = 0;

        if (!$hasManual){
            $durationWhenNoManual = ceil(($duration * self::PERCENTAGE_NO_MANUAL)/100);
        }

        return $duration + $durationPerAge + $durationPerSupport + $durationWhenNoManual;
    }

    /**
     * @param Given[] $givens
     * @return Age
     */
    private function getAge(array $givens)
    {
        foreach ($givens as $given){
            if ($given->getFeature()->getName()->is(Name::AGE)){
                return $given->getValue();
            }
        }

        return new Age(Age::NORMAL);
    }

    /**
     * @param Given[] $givens
     * @return Developer
     */
    private function getDeveloper(array $givens)
    {
        foreach ($givens as $given){
            if ($given->getFeature()->getName()->is(Name::DEVELOPER)){
                return $given->getValue();
            }
        }

        return new Developer(Developer::COMPANY);
    }

    /**
     * @param Given[] $givens
     * @return bool
     */
    private function hasManual(array $givens)
    {
        foreach ($givens as $given){
            if ($given->getFeature()->getName()->is(Name::MANUAL)){
                return $given->getValue();
            }
        }

        return true;
    }

    /**
     * @param Given[] $givens
     * @return Support
     */
    private function getSupport(array $givens)
    {
        foreach ($givens as $given){
            if ($given->getFeature()->getName()->is(Name::SUPPORT)){
                return $given->getValue();
            }
        }

        return new Support(Support::SAME_PARTIES);
    }
}