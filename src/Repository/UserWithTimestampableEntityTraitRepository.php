<?php

namespace App\Repository;

use App\Entity\UserWithTimestampableEntityTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserWithTimestampableEntityTrait|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserWithTimestampableEntityTrait|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserWithTimestampableEntityTrait[]    findAll()
 * @method UserWithTimestampableEntityTrait[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserWithTimestampableEntityTraitRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserWithTimestampableEntityTrait::class);
    }
}
