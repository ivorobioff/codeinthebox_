<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class AbstractConfigProvider
{
    /**
     * @var array
     */
    private $parameters = [];

    /**
     * @var string
     */
    protected $rootPath;

    /**
     * @param string $rootPath
     * @param EnvironmentInterface $environment
     */
    public function __construct(EnvironmentInterface $environment, $rootPath)
    {
        $this->rootPath = $rootPath;

        if ($env = $environment->getName()){
            $file = $this->rootPath . '/'.$env.'_env.php';
        } else {
            $file = $this->rootPath . '/env.php';
        }

        if (file_exists($file)) {
            $this->parameters = require $file;
        }
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function parameter($key, $default = null)
    {
        return array_get($this->parameters, $key, $default);
    }

    /**
     * @return array
     */
    abstract public function getConfig();
}