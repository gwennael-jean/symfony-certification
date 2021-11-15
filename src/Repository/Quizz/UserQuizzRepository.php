<?php

namespace App\Repository\Quizz;

use App\Entity\Quizz\UserQuizz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserQuizz|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserQuizz|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserQuizz[]    findAll()
 * @method UserQuizz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserQuizzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserQuizz::class);
    }

    public function countAll(): int
    {
        return $this->createQueryBuilder('uq')
            ->select('COUNT(uq)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
