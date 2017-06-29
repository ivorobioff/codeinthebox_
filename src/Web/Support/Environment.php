<?php
namespace ImmediateSolutions\CodeInTheBox\Web\Support;

use ImmediateSolutions\CodeInTheBox\Infrastructure\EnvironmentInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Environment implements EnvironmentInterface
{
    /**
     * @var ServerRequestInterface
     */
    private $request;

    /**
     * @param ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->request->getServerParams()['APP_ENV'] ?? null;
    }
}