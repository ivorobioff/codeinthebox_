<?php
namespace ImmediateSolutions\CodeInTheBox\Api\Support;

use ImmediateSolutions\Support\Api\AbstractSerializer;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Serializer extends AbstractSerializer
{
    /**
     * @param string $uri
     * @return string
     */
    protected function url($uri)
    {
        return 'https://what.com' . $uri;
    }
}