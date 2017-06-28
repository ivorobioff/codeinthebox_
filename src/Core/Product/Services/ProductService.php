<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Services;

use ImmediateSolutions\CodeInTheBox\Core\Product\Payloads\AnswerPayload;
use ImmediateSolutions\CodeInTheBox\Core\Support\Service;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ProductService extends Service
{
    /**
     * @param int $productId
     * @param AnswerPayload[] $answers
     * @return float
     */
    public function getPrice($productId, array $answers)
    {

    }
}