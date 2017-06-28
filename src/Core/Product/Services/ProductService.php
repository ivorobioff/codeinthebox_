<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Services;

use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Feature;
use ImmediateSolutions\CodeInTheBox\Core\Product\Interfaces\EstimatorInterface;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Estimation;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Given;
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
     * @return Estimation
     */
    public function getEstimation($productId, array $answers)
    {
        $result = [];

        foreach ($answers as $answer){
            $result[$answer->getFeature()] = $answer->getValue();
        }

        $answers = $result;

        /**
         * @var Feature[] $features
         */
        $features = $this->entityManager
            ->getRepository(Feature::class)
            ->findBy(['product' => $productId]);

        /**
         * @var Given[] $givens
         */
        $givens = array_map(function(Feature $feature) use ($answers) {
            $given = new Given();
            $given->setFeature($feature);
            $given->setValue([$feature, $answers[$feature->getId()] ?? $feature->getValue()]);
            return $given;
        }, $features);

        $totalDuration = 0;
        $totalPrice = 0;


        foreach ($givens as $given){

            $duration = $this->findEstimator($given->getFeature())->estimate($given, $givens);

            $price = $given->getFeature()->getCost() * $duration;

            $totalDuration += $duration;
            $totalPrice += $price;
        }

        $estimation = new Estimation();

        $estimation->setDuration($totalDuration);
        $estimation->setPrice($totalPrice);

        return $estimation;
    }

    /**
     * @param Feature $feature
     * @return EstimatorInterface
     */
    private function findEstimator(Feature $feature)
    {

    }

}