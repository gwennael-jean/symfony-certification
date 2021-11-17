<?php

namespace App\Repository\Quizz;

use App\Entity\Quizz\UserQuizzResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserQuizzResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserQuizzResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserQuizzResult[]    findAll()
 * @method UserQuizzResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserQuizzResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserQuizzResult::class);
    }

    // /**
    //  * @return UserQuizzResult[] Returns an array of UserQuizzResult objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserQuizzResult
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
