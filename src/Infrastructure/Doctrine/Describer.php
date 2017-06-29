<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\Doctrine;

use ImmediateSolutions\Support\Framework\ConfigInterface;
use ImmediateSolutions\Support\Infrastructure\Doctrine\Metadata\DescriberInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Describer implements DescriberInterface
{
    /**
     * @var string
     */
    private $rootPath;

    /**
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->rootPath = $config->get('root_path');
    }

    /**
     * @param string $package
     * @return string
     */
    public function getEntityNamespace($package)
    {
        return 'ImmediateSolutions\CodeInTheBox\Core\\' . $package . '\\Entities';
    }

    /**
     * @param string $package
     * @return string
     */
    public function getMetadataNamespace($package)
    {
        return 'ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\\' . $package . '\Metadata';
    }

    /**
     * @param string $package
     * @return string
     */
    public function getEntityPath($package)
    {
        return $this->rootPath.'/src/Core/' . str_replace('\\', '/', $package) . '/Entities';
    }

    /**
     * @param string $package
     * @return string
     */
    public function getTypeNamespace($package)
    {
        return 'ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\\' . $package . '\Types';
    }

    /**
     * @param string $package
     * @return string
     */
    public function getTypePath($package)
    {
        return $this->rootPath.'/src/Infrastructure/DAL/' . str_replace('\\', '/', $package) . '/Types';
    }
}