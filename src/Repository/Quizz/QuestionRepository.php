<?php

namespace App\Repository\Quizz;

use App\Entity\Quizz\Domain;
use App\Entity\Quizz\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function countAll(): int
    {
        return $this->createQueryBuilder('q')
            ->select('COUNT(q)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findRandomByDomain(Domain $domain): array
    {
        return $this->createQueryBuilder('q')
            ->andWhere(':domain MEMBER OF q.domains')
            ->setParameter('domain', $domain)
            ->orderBy('RAND()')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
}
