<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters\AgeConverter;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters\AlgorithmConverter;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters\ConverterInterface;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters\DateTimeConverter;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters\DesignConverter;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters\DeveloperConverter;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters\GoalConverter;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters\PrimitiveConverter;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\Converters\SupportConverter;
use ImmediateSolutions\Support\Infrastructure\Doctrine\AbstractType;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ValueType extends AbstractType
{
    const MARKER_PRIMITIVE = 'primitive';
    const MARKER_DATETIME = 'datetime';

    /**
     * @return ConverterInterface[]
     */
    private function getConverters()
    {
        return [
            new PrimitiveConverter(),
            new DateTimeConverter(),
            new GoalConverter(),
            new DesignConverter(),
            new AlgorithmConverter(),
            new AgeConverter(),
            new DeveloperConverter(),
            new SupportConverter()
        ];
    }

    /**
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'TEXT';
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = json_decode($value, true);

        foreach ($this->getConverters() as $converter) {

            if ($converter->supportsPHP($value)){
                return $converter->toPHP($value);
            }
        }

        throw new \RuntimeException('Unable to convert to PHP value');
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        foreach ($this->getConverters() as $converter) {

            if ($converter->supportsSQL($value)){
                return json_encode($converter->toSQL($value));
            }
        }

        throw new \RuntimeException('Unable to convert to SQL value');
    }
}