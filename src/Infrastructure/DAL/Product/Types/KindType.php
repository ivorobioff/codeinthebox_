<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Kind;
use ImmediateSolutions\Support\Infrastructure\Doctrine\EnumType;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class KindType extends EnumType
{
    /**
     * @return string
     */
    protected function getEnumClass()
    {
        return Kind::class;
    }
}