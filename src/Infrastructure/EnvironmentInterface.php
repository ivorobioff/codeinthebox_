<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface EnvironmentInterface
{
    /**
     * @return string
     */
    public function getName();
}