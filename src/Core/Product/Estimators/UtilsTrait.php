<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Estimators;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
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
    protected function getTotalModules(array $givens)
    {
        foreach ($givens as $given){
            if ($given->getFeature()->getName()->is(Name::MODULE)){
                return $given->getValue();
            }
        }

        return 0;
    }
}