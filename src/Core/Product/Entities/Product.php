<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Entities;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Kind;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Product
{
    /**
     * @var int
     */
    private $id;
    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }


    /**
     * @var Kind
     */
    private $kind;
    public function setKind(Kind $kind) { $this->kind = $kind; }
    public function getKind() { return $this->kind; }

    /**
     * @var string
     */
    private $title;
    public function setTitle($title) { $this->title = $title; }
    public function getTitle() { return $this->title; }


    /**
     * @var string
     */
    private $image;
    public function setImage($uri) { $this->image = $uri; }
    public function getImage() { return $this->image; }

    /**
     * @var string
     */
    private $shortDescription;
    public function setShortDescription($description) { $this->shortDescription = $description; }
    public function getShortDescription() { return $this->shortDescription; }

    /**
     * @var string
     */
    private $longDescription;
    public function setLongDescription($description) { $this->longDescription = $description; }
    public function getLongDescription() { return $this->longDescription; }
}