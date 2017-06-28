<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces;

use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Feature;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface EstimatorInterface
{
    /**
     * @param Feature $feature
     * @param mixed $value
     * @return int
     */
    public function estimate(Feature $feature, $value);
}