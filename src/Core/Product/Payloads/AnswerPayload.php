<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Payloads;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class AnswerPayload
{
    /**
     * @var int
     */
    private $feature;
    public function setFeature($feature) { $this->feature = $feature; }
    public function getFeature() { return $this->feature; }

    /**
     * @var mixed
     */
    private $value;
    public function setValue($value) { $this->value = $value; }
    public function getValue() { return $this->value; }
}