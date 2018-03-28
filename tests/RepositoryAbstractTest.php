<?php
declare(strict_types=1);
namespace App\Tests;

use App\Entity\User;
use App\Entity\UserWithTimestampableEntityTrait;
use Doctrine\ORM\Tools\SchemaTool;
use Monolog\Handler\TestHandler;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author     Kamil Maras
 */
abstract class RepositoryAbstractTest extends KernelTestCase
{
    /** @var array */
    protected static $databaseClass = [User::class, UserWithTimestampableEntityTrait::class];

    /** @var \Doctrine\ORM\EntityManager */
    protected $em;

    /** @var \Symfony\Bridge\Monolog\Logger */
    protected $logger;

    /** @var TestHandler */
    private $logHandler;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()->get('doctrine')->getManager();
        $this->logHandler = new TestHandler();
        $this->logger = new Logger('test', [$this->logHandler]);

        $tool = new SchemaTool($this->em);
        $metadata = [];
        foreach (self::$databaseClass as $className) {
            $metadata [] = $this->em->getClassMetadata($className);
        }
        $tool->updateSchema($metadata, true);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null;
    }

    /**
     * @param $entityName
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    protected function getRepository(string $entityName)
    {
        return $this->em->getRepository($entityName);
    }

}