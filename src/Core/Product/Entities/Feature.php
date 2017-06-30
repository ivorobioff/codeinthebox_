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
     * @var Product
     */
    private $product;
    public function setProduct(Product $product) { $this->product = $product; }
    public function getProduct() { return $this->product; }

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
     * @var bool
     */
    private $estimable = true;
    public function setEstimable($flag) { $this->estimable = $flag; }
    public function getEstimable() { return $this->estimable; }

    /**
     * @var mixed
     */
    private $value;
    public function setValue($value) { $this->value = $value; }
    public function getValue() { return $this->value; }
}