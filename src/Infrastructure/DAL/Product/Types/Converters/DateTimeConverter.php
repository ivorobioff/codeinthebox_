<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class DateTimeConverter implements ConverterInterface
{
    const MARKER = 'datetime';

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
        return $value instanceof \DateTime;
    }

    /**
     * @param mixed|\DateTime $value
     * @return array
     */
    public function toSQL($value)
    {
        return ['_' => self::MARKER, 'value' => $value->format(\DateTime::ATOM)];
    }

    /**
     * @param array $value
     * @return mixed
     */
    public function toPHP($value)
    {
        return new \DateTime($value['value']);
    }
}