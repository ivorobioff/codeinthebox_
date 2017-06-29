<?php
namespace ImmediateSolutions\CodeInTheBox\Web\Home\Controllers;

use ImmediateSolutions\CodeInTheBox\Api\Product\Serializers\ProductSerializer;
use ImmediateSolutions\CodeInTheBox\Core\Product\Services\ProductService;
use ImmediateSolutions\CodeInTheBox\Web\Support\Controller;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class HomeController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @param ProductService $productService
     */
    public function initialize(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @return ResponseInterface
     */
    public function index()
    {
        $products = array_map(
            $this->container->get(ProductSerializer::class),
            $this->productService->getAll()
        );

        return $this->show('/home/index', [
            'products' => $products
        ]);
    }
}