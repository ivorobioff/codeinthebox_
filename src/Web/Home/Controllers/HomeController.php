<?php
namespace ImmediateSolutions\CodeInTheBox\Web\Home\Controllers;

use ImmediateSolutions\CodeInTheBox\Web\Support\Controller;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class HomeController extends Controller
{
    /**
     * @return ResponseInterface
     */
    public function index()
    {
        return $this->show('/home/index');
    }
}