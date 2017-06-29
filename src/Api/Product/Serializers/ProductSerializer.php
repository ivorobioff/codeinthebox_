<?php
namespace ImmediateSolutions\CodeInTheBox\Api\Product\Serializers;

use ImmediateSolutions\CodeInTheBox\Api\Support\Serializer;
use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Product;
use ImmediateSolutions\CodeInTheBox\Core\Product\Services\ProductService;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ProductSerializer extends Serializer
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param Product $product
     * @return array
     */
    public function __invoke(Product $product)
    {
        $estimation = $this->productService->getEstimation($product->getId());

        return [
            'id' => $product->getId(),
            'title' => $product->getTitle(),
            'kind' => $this->enum($product->getKind()),
            'image' => $this->url($product->getImage()),
            'shortDescription' => $product->getShortDescription(),
            'longDescription' => $product->getLongDescription(),
            'duration' => $estimation->getDuration(),
            'price' => $estimation->getPrice()
        ];
    }
}