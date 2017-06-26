<?php
namespace ImmediateSolutions\CodeInTheBox\Web;

use ImmediateSolutions\Support\Framework\ContainerPopulatorInterface;
use ImmediateSolutions\Support\Framework\ContainerRegisterInterface;
use ImmediateSolutions\Support\Framework\RouteRegisterInterface;

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

        $populator->instance(RouteRegisterInterface::class, RouteRegister::class);
    }
}