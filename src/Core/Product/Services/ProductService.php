<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Services;

use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Feature;
use ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\EmptyEstimator;
use ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\KeywordEstimator;
use ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\SpecificationEstimator;
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

            $duration = $this->findEstimator($given, $givens)->estimate($given, $givens);

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
     * @return EstimatorInterface[]
     */
    private function getEstimators()
    {
        return [
            new KeywordEstimator(),
            new SpecificationEstimator()
        ];
    }

    /**
     * @param Given $given
     * @param array $givens
     * @return EstimatorInterface
     */
    private function findEstimator(Given $given, array $givens)
    {
        foreach ($this->getEstimators() as $estimator){
            if ($estimator->supports($given, $givens)){
                return $estimator;
            }
        }

        return new EmptyEstimator();
    }

}