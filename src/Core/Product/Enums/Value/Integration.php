<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value;

use ImmediateSolutions\Support\Other\Enum;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Integration extends Enum
{
    const MAILCHIMP = 'mailchimp';
    const MAILGUN = 'mailgun';
    const PAYPAL = 'paypal';
    const STRIPE = 'stripe';
    const AUTHORIZE_NET = 'authorize-net';
}