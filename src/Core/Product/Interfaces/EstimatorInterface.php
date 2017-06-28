<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces;

use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Feature;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface EstimatorInterface
{
    /**
     * @param Given $given
     * @param Given[] $givens
     * @return int
     */
    public function estimate(Given $given, array $givens);
}