<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Entities;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Answer
{
    /**
     * @var int
     */
    private $id;
    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

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