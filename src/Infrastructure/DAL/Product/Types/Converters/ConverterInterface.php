<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface ConverterInterface
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function supportsSQL($value);

    /**
     * @param array $value
     * @return bool
     */
    public function supportsPHP($value);

    /**
     * @param mixed $value
     * @return array
     */
    public function toSQL($value);

    /**
     * @param array $value
     * @return mixed
     */
    public function toPHP($value);
}