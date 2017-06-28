<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Enums;

use ImmediateSolutions\Support\Other\Enum;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Scope extends Enum
{
    const INTERNAL = 'internal';
    const INCLUDED = 'included';
    const SELECTABLE = 'selectable';
}