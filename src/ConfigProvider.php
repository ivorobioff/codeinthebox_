<?php
namespace ImmediateSolutions\CodeInTheBox;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Proxy\AbstractProxyFactory;
use ImmediateSolutions\CodeInTheBox\Infrastructure\AbstractConfigProvider;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ConfigProvider extends AbstractConfigProvider
{
    /**
     * @return array
     */
    public function getConfig()
    {
        return [
            'root_path' => $this->rootPath,

            'debug' => $this->parameter('debug', false),

            'packages' => [
                'Product'
            ],

            'doctrine' => [
                'db' => 'default',

                'connections' => [
                    'default' => [
                        'driver' => 'pdo_mysql',
                        'user' => $this->parameter('database.username'),
                        'password' => $this->parameter('database.password'),
                        'dbname' => $this->parameter('database.name'),
                        'charset' => 'utf8',
                        'host' => $this->parameter('database.host')
                    ]
                ],

                'cache' => ArrayCache::class,
                'proxy' => [
                    'auto' => AbstractProxyFactory::AUTOGENERATE_ALWAYS,
                    'dir' => $this->rootPath.'/.sparrow/proxies',
                    'namespace' => 'ImmediateSolutions\CodeInTheBox\Proxies'
                ],
                'migrations' => [
                    'dir' => $this->rootPath.'/migrations',
                    'namespace' => 'ImmediateSolutions\CodeInTheBox\Migrations',
                    'table' => 'migrations'
                ],
                'entities' => [
                    //
                ],

                'types' => [
                    //
                ]
            ],
        ];
    }
}