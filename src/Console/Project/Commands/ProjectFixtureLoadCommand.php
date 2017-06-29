<?php
namespace ImmediateSolutions\CodeInTheBox\Console\Project\Commands;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use ImmediateSolutions\CodeInTheBox\Infrastructure\Fixture\Product\FeatureFixture;
use ImmediateSolutions\CodeInTheBox\Infrastructure\Fixture\Product\ProductFixture;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ProjectFixtureLoadCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setName('project:fixture:load')
            ->setDescription('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $loader = new Loader();

        foreach ($this->getFixtures() as $fixture){
            $loader->addFixture($fixture);
        }

        $purger = new ORMPurger();

        $executor = new ORMExecutor($this->entityManager, $purger);

        $executor->execute($loader->getFixtures());
    }

    /**
     * @return FixtureInterface[]
     */
    protected function getFixtures()
    {
        return [
            new ProductFixture(1),
            new FeatureFixture(2)
        ];
    }
}