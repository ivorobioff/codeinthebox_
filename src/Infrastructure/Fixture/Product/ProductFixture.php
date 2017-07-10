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
    const REFERENCE_INTEGRATION = 'product_integration';
    const REFERENCE_WORDPRESS_THEME = 'product_wordpress_theme';
    const REFERENCE_WEB_SERVICE = 'product_web_service';
    const REFERENCE_COMPANY_WEBSITE = 'product_company_website';

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->addWebApplicationProduct($manager);
        $this->addRedevelopmentProduct($manager);
        $this->addIntegrationProduct($manager);
        $this->addWordpressThemeProduct($manager);
        $this->addWebServiceProduct($manager);
        $this->addCompanyWebsiteProduct($manager);

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    private function addCompanyWebsiteProduct(ObjectManager $manager)
    {
        $product = new Product();
        $product->setKind(new Kind(Kind::COMPANY_WEBSITE));
        $product->setTitle('Company Website');
        $product->setShortDescription('A website to represent your company, list products you offer');
        $product->setLongDescription('A website to represent your company, list products you offer');

        $manager->persist($product);

        $this->setReference(self::REFERENCE_COMPANY_WEBSITE, $product);
    }

    /**
     * @param ObjectManager $manager
     */
    private function addWebServiceProduct(ObjectManager $manager)
    {
        $product = new Product();
        $product->setKind(new Kind(Kind::WEB_SERVICE));
        $product->setTitle('Web Service');
        $product->setShortDescription('An web service to support your mobile application and more');
        $product->setLongDescription('An web service to support your mobile application and more');

        $manager->persist($product);

        $this->setReference(self::REFERENCE_WEB_SERVICE, $product);
    }

    /**
     * @param ObjectManager $manager
     */
    private function addWordpressThemeProduct(ObjectManager $manager)
    {
        $product = new Product();
        $product->setKind(new Kind(Kind::WORDPRESS_THEME));
        $product->setTitle('Wordpress Theme');
        $product->setShortDescription('A beautiful theme for your Wordpress website as per your requirements');
        $product->setLongDescription('A beautiful theme for your Wordpress website as per your requirements');

        $manager->persist($product);

        $this->setReference(self::REFERENCE_WORDPRESS_THEME, $product);
    }


    /**
     * @param ObjectManager $manager
     */
    private function addIntegrationProduct(ObjectManager $manager)
    {
        $product = new Product();
        $product->setKind(new Kind(Kind::INTEGRATION));
        $product->setTitle('Integration');
        $product->setShortDescription('Integration of 3rd party systems with your existing system');
        $product->setLongDescription('Integration of 3rd party systems with your existing system');

        $manager->persist($product);

        $this->setReference(self::REFERENCE_INTEGRATION, $product);
    }

    /**
     * @param ObjectManager $manager
     */
    private function addRedevelopmentProduct(ObjectManager $manager)
    {
        $product = new Product();
        $product->setKind(new Kind(Kind::REDEVELOPMENT));
        $product->setTitle('Redevelopment');
        $product->setShortDescription('Redevelopment/redesigning of an existing website');
        $product->setLongDescription('Redevelopment/redesigning of an existing website');

        $manager->persist($product);

        $this->setReference(self::REFERENCE_REDEVELOPMENT, $product);
    }

    /**
     * @param ObjectManager $manager
     */
    private function addWebApplicationProduct(ObjectManager $manager)
    {
        $product = new Product();

        $product->setKind(new Kind(Kind::WEB_APPLICATION));
        $product->setTitle('Web Application');
        $product->setShortDescription('Interactive, highly customizable software');
        $product->setLongDescription('Interactive, highly customizable software');

        $manager->persist($product);
        $this->setReference(self::REFERENCE_WEB_APPLICATION, $product);
    }
}