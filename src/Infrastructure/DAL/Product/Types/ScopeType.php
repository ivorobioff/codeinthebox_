<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types;

use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Scope;
use ImmediateSolutions\Support\Infrastructure\Doctrine\EnumType;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ScopeType extends EnumType
{
    /**
     * @return string
     */
    protected function getEnumClass()
    {
        return Scope::class;
    }
}