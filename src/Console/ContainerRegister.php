<?php
namespace ImmediateSolutions\CodeInTheBox\Console;

use ImmediateSolutions\Support\Framework\CommandRegisterInterface;
use ImmediateSolutions\Support\Framework\ContainerPopulatorInterface;
use ImmediateSolutions\Support\Framework\ContainerRegisterInterface;
use ImmediateSolutions\CodeInTheBox\Console\Support\Environment;
use ImmediateSolutions\CodeInTheBox\Infrastructure\EnvironmentInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ContainerRegister implements ContainerRegisterInterface
{
    /**
     * @var string
     */
    private $rootPath;

    /**
     * @param string $rootPath
     */
    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }

    /**
     * @param ContainerPopulatorInterface $populator
     */
    public function register(ContainerPopulatorInterface $populator)
    {
        (new \ImmediateSolutions\Support\Infrastructure\ContainerRegister())->register($populator);
        (new \ImmediateSolutions\CodeInTheBox\Infrastructure\ContainerRegister($this->rootPath))->register($populator);
        (new \ImmediateSolutions\Support\Console\ContainerRegister())->register($populator);

        $populator
            ->service(CommandRegisterInterface::class, CommandRegister::class)
            ->service(EnvironmentInterface::class, Environment::class);
    }
}