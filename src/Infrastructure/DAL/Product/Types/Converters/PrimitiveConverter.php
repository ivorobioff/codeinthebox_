<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class PrimitiveConverter implements ConverterInterface
{
    const MARKER = 'primitive';

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
     * @return bool
     */
    public function supportsSQL($value)
    {
        return !is_object($value);
    }

    /**
     * @param mixed $value
     * @return array
     */
    public function toSQL($value)
    {
        return ['_' => self::MARKER, 'value' => $value];
    }

    /**
     * @param array $value
     * @return mixed
     */
    public function toPHP($value)
    {
        return $value['value'];
    }
}