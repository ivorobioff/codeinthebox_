<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Objects;

use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Feature;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Given
{
    /**
     * @var Feature
     */
    private $feature;
    public function setFeature(Feature $feature) { $this->feature = $feature; }
    public function getFeature() { return $this->feature; }

    /**
     * @var mixed
     */
    private $value;
    public function setValue($value) { $this->value = $value; }
    public function getValue() { return $this->value; }
}