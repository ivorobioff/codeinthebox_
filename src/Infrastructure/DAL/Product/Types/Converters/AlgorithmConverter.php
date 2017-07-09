<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Algorithm;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class AlgorithmConverter implements ConverterInterface
{
    const MARKER = 'algorithm';

    /**
     * @param mixed $value
     * @return bool
     */
    public function supportsSQL($value)
    {
        return $value instanceof Algorithm;
    }

    /**
     * @param array $value
     * @return bool
     */
    public function supportsPHP($value)
    {
        return $value['_'] === self::MARKER;
    }

    /**
     * @param mixed $value
     * @return array
     */
    public function toSQL($value)
    {
        return ['_' => self::MARKER, 'value' => (string) $value];
    }

    /**
     * @param array $value
     * @return mixed
     */
    public function toPHP($value)
    {
        return new Algorithm($value['value']);
    }
}