<?php
namespace ImmediateSolutions\CodeInTheBox\Console;

use Doctrine\ORM\EntityManagerInterface;
use ImmediateSolutions\Support\Framework\CommandRegisterInterface;
use ImmediateSolutions\Support\Framework\CommandStorageInterface;
use ImmediateSolutions\Support\Framework\ContainerInterface;
use ImmediateSolutions\CodeInTheBox\Console\Project\Commands\ProjectFixtureLoadCommand;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class CommandRegister implements CommandRegisterInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param CommandStorageInterface $storage
     */
    public function register(CommandStorageInterface $storage)
    {
        (new \ImmediateSolutions\Support\Console\CommandRegister($this->container))->register($storage);

        $storage->add(new ProjectFixtureLoadCommand($this->container->get(EntityManagerInterface::class)));
    }
}