<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Enums;

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

    public function titles()
    {
        return [
            self::MAILCHIMP => 'MailChimp',
            self::MAILGUN => 'Mailgun',
            self::PAYPAL => 'PayPal',
            self::STRIPE => 'Stripe',
            self::AUTHORIZE_NET => 'Authorize.Net'
        ];
    }
}