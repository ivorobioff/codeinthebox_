<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure;

use ImmediateSolutions\Support\Framework\ContainerInterface;
use ImmediateSolutions\CodeInTheBox\ConfigProvider;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ConfigProviderFactory
{
    /**
     * @var
     */
    private $rootPath;

    /**
     * @param string $rootPath
     */
    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }

    public function __invoke(ContainerInterface $container)
    {
        return new ConfigProvider($container->get(EnvironmentInterface::class), $this->rootPath);
    }
}