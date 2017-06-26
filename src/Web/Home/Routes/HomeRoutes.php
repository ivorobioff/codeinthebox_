<?php
namespace ImmediateSolutions\CodeInTheBox\Web\Home\Routes;

use ImmediateSolutions\CodeInTheBox\Web\Home\Controllers\HomeController;
use ImmediateSolutions\Support\Framework\RouterInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class HomeRoutes
{
    public function __invoke(RouterInterface $router)
    {
        $router->get('/', HomeController::class.'@index');
    }
}