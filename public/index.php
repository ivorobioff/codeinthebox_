<?php
/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */

require __DIR__.'/../vendor/autoload.php';

(new \ImmediateSolutions\Support\Framework\Web(
    new \ImmediateSolutions\CodeInTheBox\Web\ContainerRegister(__DIR__.'/..')))->run();