<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\Support\Infrastructure\Doctrine\EnumType;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class NameType extends EnumType
{
    /**
     * @return string
     */
    protected function getEnumClass()
    {
        return Name::class;
    }
}