<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Support;

use Doctrine\ORM\EntityManagerInterface;
use ImmediateSolutions\Support\Core\Interfaces\ContainerInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class Service
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->entityManager = $container->get(EntityManagerInterface::class);
    }
}