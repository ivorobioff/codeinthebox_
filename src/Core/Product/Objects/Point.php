<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Objects;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Point
{
    /**
     * @var string
     */
    private $integration;
    public function setIntegration($integration) { $this->integration = $integration; }
    public function getIntegration() { return $this->integration; }

    /**
     * @var array
     */
    private $places;
    public function setPlaces(array $places) { $this->places = $places; }
    public function getPlaces() { return $this->places; }
}