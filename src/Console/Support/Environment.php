<?php
namespace ImmediateSolutions\CodeInTheBox\Console\Support;

use ImmediateSolutions\CodeInTheBox\Infrastructure\EnvironmentInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Environment implements EnvironmentInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return null;
    }
}