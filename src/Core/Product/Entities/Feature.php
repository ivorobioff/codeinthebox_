<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Entities;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Scope;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Feature
{
    /**
     * @var int
     */
    private $id;
    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    /**
     * @var Name
     */
    private $name;
    public function setName(Name $name) { $this->name = $name; }
    public function getName() { return $this->name; }

    /**
     * @var Scope
     */
    private $scope;
    public function setScope(Scope $scope) { $this->scope = $scope; }
    public function getScope() { return $this->scope; }

    /**
     * @var float
     */
    private $cost;
    public function setCost($cost) { $this->cost = $cost; }
    public function getCost() { return $this->cost; }

    /**
     * @var mixed
     */
    private $value;
    public function setValue($value) { $this->value = $value; }
    public function getValue() { return $this->value; }
}