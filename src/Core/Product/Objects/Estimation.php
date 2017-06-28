<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Objects;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Estimation
{
    /**
     * @var float
     */
    private $price;
    public function setPrice($price) { $this->price = $price; }
    public function getPrice() { return $this->price; }

    /**
     * @var int
     */
    private $duration;
    public function setDuration($duration) { $this->duration = $duration; }
    public function getDuration() { return $this->duration; }
}