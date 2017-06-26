<?php
namespace ImmediateSolutions\CodeInTheBox\Web;

use ImmediateSolutions\CodeInTheBox\Web\Home\Routes\HomeRoutes;
use ImmediateSolutions\Support\Framework\RouteRegisterInterface;
use ImmediateSolutions\Support\Framework\RouterInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class RouteRegister implements RouteRegisterInterface
{
    /**
     * @param RouterInterface $router
     */
    public function register(RouterInterface $router)
    {
        (new HomeRoutes())($router);
    }
}