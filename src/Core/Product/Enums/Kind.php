<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Enums;

use ImmediateSolutions\Support\Other\Enum;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Kind extends Enum
{
    const WEB_APPLICATION = 'web-application';
    const SCRIPT = 'script';
    const WORDPRESS_THEME = 'wordpress-theme';
}