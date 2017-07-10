<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Goal;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Website;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
trait UtilsTrait
{
    /**
     * @param Given[] $givens
     * @return int
     */
    protected function countModules(array $givens)
    {
        foreach ($givens as $given){
            if ($given->getFeature()->getName()->is(Name::MODULE)){
                return count($given->getValue());
            }
        }

        return 0;
    }

    /**
     * @param Given[] $givens
     * @return Goal
     */
    protected function getGoal(array $givens)
    {
        foreach ($givens as $given){
            if ($given->getFeature()->getName()->is(Name::GOAL)){
                return $given->getValue();
            }
        }

        return new Goal(Goal::MVP);
    }

    /**
     * @param Given[] $givens
     * @return int
     */
    protected function getPages(array $givens)
    {
        foreach ($givens as $given){
            if ($given->getFeature()->getName()->is(Name::PAGE)){
                return $given->getValue();
            }
        }

        return 0;
    }

    /**
     * @param Given[] $givens
     * @return Website
     */
    protected function getWebsite(array $givens)
    {
        foreach ($givens as $given){
            if ($given->getFeature()->getName()->is(Name::WEBSITE)){
                return $given->getValue();
            }
        }

        return new Website(Website::COMPANY_WEBSITE);
    }
}