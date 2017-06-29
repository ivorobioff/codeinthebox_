<?php
namespace ImmediateSolutions\CodeInTheBox\Web\Support;

use ImmediateSolutions\CodeInTheBox\Web\Support\Modifiers\DurationModifier;
use ImmediateSolutions\Support\Framework\ContainerInterface;
use League\Plates\Engine;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class EngineInitializer
{
    public function __invoke(Engine $engine, ContainerInterface $container)
    {
        $engine->registerFunction('duration', new DurationModifier());
    }
}