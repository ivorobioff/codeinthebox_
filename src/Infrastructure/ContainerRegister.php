<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure;

use ImmediateSolutions\Support\Framework\ConfigInterface;
use ImmediateSolutions\Support\Framework\ContainerPopulatorInterface;
use ImmediateSolutions\Support\Framework\ContainerRegisterInterface;
use ImmediateSolutions\Support\Framework\ContextInterface;
use ImmediateSolutions\Support\Infrastructure\Doctrine\Metadata\DescriberInterface;
use ImmediateSolutions\CodeInTheBox\ConfigProvider;
use ImmediateSolutions\CodeInTheBox\Infrastructure\Doctrine\Describer;

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
     * @param $rootPath
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
        $populator
            ->service(ConfigProvider::class, new ConfigProviderFactory($this->rootPath))
            ->service(ConfigInterface::class, Config::class)
            ->service(ContextInterface::class, Context::class)
            ->instance(DescriberInterface::class, Describer::class);
    }
}