<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\Fixture\Product;

use Doctrine\Common\Persistence\ObjectManager;
use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Feature;
use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Product;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Goal;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Scope;
use ImmediateSolutions\CodeInTheBox\Infrastructure\Fixture\Support\Fixture;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class FeatureFixture extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var Product $product
         */
        $product = $this->getReference(ProductFixture::REFERENCE_WEB_APPLICATION);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::MODULE));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(5);


        $manager->persist($feature);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::GOAL));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(new Goal(Goal::MVP));
        $feature->setEstimable(false);


        $manager->persist($feature);


        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::SPECIFICATION));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(true);

        $manager->persist($feature);

        $manager->flush();
    }
}