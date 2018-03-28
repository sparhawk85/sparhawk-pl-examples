<?php
declare(strict_types=1);
namespace App\Tests;

use App\Entity\User;

/**
 * @author     Kamil Maras
 */
class UserTest extends RepositoryAbstractTest
{
    /**
     * @test
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createUser()
    {
        $user = (new User())
            ->setName('Test');
        $this->em->persist($user);
        $this->em->flush();
        $firstModification = clone $user->getLastModifiedAt();
        $this->assertInstanceOf(\DateTime::class, $user->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $user->getLastModifiedAt());

        sleep(2);

        $user = $user->setName('Test2');
        $this->em->persist($user);
        $this->em->flush();
        $this->assertGreaterThan(
            $firstModification->format('Y-m-d H:i:s'),
            $user->getLastModifiedAt()->format('Y-m-d H:i:s')
        );
    }
}