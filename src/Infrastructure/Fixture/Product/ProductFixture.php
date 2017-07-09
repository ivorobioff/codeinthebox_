<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\Fixture\Product;

use Doctrine\Common\Persistence\ObjectManager;
use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Product;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Kind;
use ImmediateSolutions\CodeInTheBox\Infrastructure\Fixture\Support\Fixture;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ProductFixture extends Fixture
{
    const REFERENCE_WEB_APPLICATION = 'product_web_application';
    const REFERENCE_REDEVELOPMENT = 'product_redevelopment';

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $product = new Product();

        $product->setKind(new Kind(Kind::WEB_APPLICATION));
        $product->setTitle('Web Application');
        $product->setLongDescription('Interactive, highly customizable software');
        $product->setShortDescription('Interactive, highly customizable software');

        $manager->persist($product);
        $manager->flush();

        $this->setReference(self::REFERENCE_WEB_APPLICATION, $product);

        $product = new Product();
        $product->setKind(new Kind(Kind::REDEVELOPMENT));
        $product->setTitle('Redevelopment');
        $product->setLongDescription('Redevelopment/redesigning of an existing website');
        $product->setShortDescription('Redevelopment/redesigning of an existing website');

        $manager->persist($product);
        $manager->flush();

        $this->setReference(self::REFERENCE_REDEVELOPMENT, $product);
    }
}