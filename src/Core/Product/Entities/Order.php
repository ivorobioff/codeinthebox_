<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Entities;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Order
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var Answer[]
     */
    private $answers;

    /**
     * @var int
     */
    private $duration;

    /**
     * @var float
     */
    private $price;
}