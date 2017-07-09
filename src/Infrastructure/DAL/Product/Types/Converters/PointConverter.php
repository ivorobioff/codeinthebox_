<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters;

use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Point;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class PointConverter implements ConverterInterface
{
    const MARKER = 'point';

    /**
     * @param mixed $value
     * @return bool
     */
    public function supportsSQL($value)
    {
        return is_array($value) && isset($value[0]) && $value[0] instanceof Point;
    }

    /**
     * @param array $value
     * @return bool
     */
    public function supportsPHP($value)
    {
        return $value['_'] == self::MARKER;
    }

    /**
     * @param mixed|Point[] $value
     * @return array
     */
    public function toSQL($value)
    {
        return [
            '_' => self::MARKER,
            'value' => array_map(function(Point $point){
                return [
                    'integration' => $point->getIntegration(),
                    'places' => $point->getPlaces()
                ];
            }, $value)
        ];
    }

    /**
     * @param array $value
     * @return mixed
     */
    public function toPHP($value)
    {
        return array_map(function(array $item){
            $point = new Point();
            $point->setIntegration($item['integration']);
            $point->setPlaces($item['places']);
            return $point;
        }, $value['value']);
    }
}