<?php
declare(strict_types=1);
namespace App\Tests;

use App\Entity\UserWithTimestampableEntityTrait;

/**
 * @author     Kamil Maras
 */
class UserWithTimestampableEntityTraitTest extends RepositoryAbstractTest
{
    /**
     * @test
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createUser()
    {
        $user = new UserWithTimestampableEntityTrait();
        $this->em->persist($user);
        $this->em->flush();

        $this->assertInstanceOf(\DateTime::class, $user->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $user->getUpdatedAt());
    }
}