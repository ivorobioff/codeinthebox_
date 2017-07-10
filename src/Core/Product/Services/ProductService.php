<?php
namespace ImmediateSolutions\CodeInTheBox\Core\Product\Services;

use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Feature;
use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Product;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Kind;
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
     * @return Product[]
     */
    public function getAll()
    {
        return $this->entityManager->getRepository(Product::class)->findAll();
    }

    /**
     * @param int $productId
     * @param AnswerPayload[] $answers
     * @return Estimation
     */
    public function getEstimation($productId, array $answers = [])
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
            $given->setValue($answers[$feature->getId()] ?? $feature->getValue());
            return $given;
        }, $features);

        $totalDuration = 0;
        $totalPrice = 0;


        foreach ($givens as $given){

            $feature = $given->getFeature();

            if (!$feature->getEstimable()){
                continue ;
            }

            $estimation = $this->findEstimator($given, $givens)->estimate($given, $givens);

            $totalDuration += $estimation->getDuration();
            $totalPrice += $estimation->getPrice();
        }

        $estimation = new Estimation();

        $estimation->setDuration($totalDuration);
        $estimation->setPrice($totalPrice);

        return $estimation;
    }

    /**
     * @param Kind $kind
     * @return array
     */
    private function getEstimators(Kind $kind)
    {
        return ([
            Kind::COMPANY_WEBSITE => [
                \ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\CompanyWebsite\DesignEstimator::class,
            ],
            Kind::REDEVELOPMENT => [
                \ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\Redevelopment\ModuleEstimator::class,
                \ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\Redevelopment\DesignEstimator::class
            ],
            Kind::WEB_APPLICATION => [
                \ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\WebApplication\DesignEstimator::class,
                \ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\WebApplication\IntegrationEstimator::class,
                \ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\WebApplication\SpecificationEstimator::class ,
                \ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\WebApplication\TestEstimator::class,
                \ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\WebApplication\ModuleEstimator::class,
                \ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\WebApplication\AlgorithmEstimator::class
            ],
            Kind::INTEGRATION => [
                \ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\Integration\PointEstimator::class,
            ],
            Kind::WORDPRESS_THEME => [
                \ImmediateSolutions\CodeInTheBox\Core\Product\Estimators\WordpressTheme\DesignEstimator::class,
            ]
        ])[(string) $kind];
    }

    /**
     * @param Given $given
     * @param array $givens
     * @return EstimatorInterface
     */
    private function findEstimator(Given $given, array $givens)
    {
        $feature = $given->getFeature();
        $product = $feature->getProduct();

        foreach ($this->getEstimators($product->getKind()) as $estimator){
            /**
             * @var EstimatorInterface $estimator
             */
            $estimator = new $estimator();
            if ($estimator->supports($given, $givens)){
                return $estimator;
            }
        }

        throw new \RuntimeException('Unable to find estimator for the "'
            .$product->getKind().'" product and the "'.$feature->getName().'" feature');
    }

}