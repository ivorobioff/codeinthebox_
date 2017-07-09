<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\Fixture\Product;

use Doctrine\Common\Persistence\ObjectManager;
use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Feature;
use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Product;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Age;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Algorithm;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Design;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Developer;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Goal;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Name;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Scope;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Integration;
use ImmediateSolutions\CodeInTheBox\Core\Product\Enums\Value\Support;
use ImmediateSolutions\CodeInTheBox\Core\Product\Objects\Point;
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
        $this->addWebApplicationFeatures($manager);
        $this->addRedevelopmentFeatures($manager);
        $this->addIntegrationFeatures($manager);

        $manager->flush();
    }

    private function addIntegrationFeatures(ObjectManager $manager)
    {
        /**
         * @var Product $product
         */
        $product = $this->getReference(ProductFixture::REFERENCE_INTEGRATION);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::POINT));
        $feature->setScope(new Scope(Scope::OUTER));

        $point = new Point();

        $point->setIntegration(Integration::MAILGUN);

        $point->setPlaces(['', '', '', '', '']);

        $feature->setValue([$point]);

        $manager->persist($feature);
    }


    /**
     * @param ObjectManager $manager
     */
    private function addRedevelopmentFeatures(ObjectManager $manager)
    {
        /**
         * @var Product $product
         */
        $product = $this->getReference(ProductFixture::REFERENCE_REDEVELOPMENT);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::MODULE));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(['', '', '', '', '']);

        $manager->persist($feature);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::MANUAL));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(true);

        $manager->persist($feature);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::DEVELOPER));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(Developer::COMPANY);

        $manager->persist($feature);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::SUPPORT));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(Support::SAME_PARTIES);

        $manager->persist($feature);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::AGE));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(new Age(Age::NORMAL));

        $manager->persist($feature);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::DESIGN));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(new Design(Design::EXISTING));

        $manager->persist($feature);
    }

    /**
     * @param ObjectManager $manager
     */
    private function addWebApplicationFeatures(ObjectManager $manager)
    {
        /**
         * @var Product $product
         */
        $product = $this->getReference(ProductFixture::REFERENCE_WEB_APPLICATION);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::MODULE));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(['', '', '', '', '']);


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
        $feature->setName(new Name(Name::DESIGN));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(new Design(Design::ANY));

        $manager->persist($feature);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::TEST));
        $feature->setScope(new Scope(Scope::INNER));

        $manager->persist($feature);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::INTEGRATION));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue([]);

        $manager->persist($feature);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::ALGORITHM));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(new Algorithm(Algorithm::NO));

        $manager->persist($feature);

        $feature = new Feature();
        $feature->setProduct($product);
        $feature->setName(new Name(Name::SPECIFICATION));
        $feature->setScope(new Scope(Scope::OUTER));
        $feature->setValue(true);

        $manager->persist($feature);
    }
}