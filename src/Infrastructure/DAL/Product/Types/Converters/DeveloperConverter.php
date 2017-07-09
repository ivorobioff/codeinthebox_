<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Developer;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class DeveloperConverter implements ConverterInterface
{
    const MARKER = 'developer';

    /**
     * @param mixed $value
     * @return bool
     */
    public function supportsSQL($value)
    {
        return $value instanceof Developer;
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
        return new Developer($value['value']);
    }
}