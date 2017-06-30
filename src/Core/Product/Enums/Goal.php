<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Enums;

use ImmediateSolutions\Support\Other\Enum;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Goal extends Enum
{
    const PROTOTYPE = 'prototype';
    const MVP = 'mvp';
    const FULLY_COMPLETED = 'fully-completed';
}