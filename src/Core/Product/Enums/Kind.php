<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Enums;

use ImmediateSolutions\Support\Other\Enum;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Kind extends Enum
{
    const WEB_APPLICATION = 'web-application';
    const REDEVELOPMENT = 'redevelopment';
    const INTEGRATION = 'integration';
    const WORDPRESS_THEME = 'wordpress-theme';
    const COMPANY_WEBSITE = 'company-website';
    const WEB_SERVICE = 'web-service';
}