<?php
namespace ImmediateSolutions\CodeInTheBox\Web;

use ImmediateSolutions\CodeInTheBox\Infrastructure\EnvironmentInterface;
use ImmediateSolutions\CodeInTheBox\Web\Support\EngineInitializer;
use ImmediateSolutions\CodeInTheBox\Web\Support\Environment;
use ImmediateSolutions\Support\Api\JsonResponseFactory;
use ImmediateSolutions\Support\Api\ResponseFactoryInterface;
use ImmediateSolutions\Support\Framework\ContainerPopulatorInterface;
use ImmediateSolutions\Support\Framework\ContainerRegisterInterface;
use ImmediateSolutions\Support\Framework\RouteRegisterInterface;
use League\Plates\Engine;

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
        (new \ImmediateSolutions\Support\Web\ContainerRegister($this->rootPath.'/resources/views'))->register($populator);

        (new \ImmediateSolutions\CodeInTheBox\Infrastructure\ContainerRegister($this->rootPath))->register($populator);

        $populator
            ->instance(RouteRegisterInterface::class, RouteRegister::class)
            ->instance(ResponseFactoryInterface::class, JsonResponseFactory::class)
            ->service(EnvironmentInterface::class, Environment::class)
            ->initialize(Engine::class, new EngineInitializer());
    }
}