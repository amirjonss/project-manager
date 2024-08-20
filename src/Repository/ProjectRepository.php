<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Project>
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    //    /**
    //     * @return Project[] Returns an array of Project objects
    //     */
        public function getAvgAgeProjectEmployees(Project $project): int
        {
            $result = $this->createQueryBuilder('p')
                ->select('AVG(pe.age)')
                ->leftJoin('p.employees', 'pe')
                ->andWhere('p.id = :id')
                ->setParameter('id', $project->getId())
                ->getQuery()
                ->getSingleScalarResult()
            ;

            if ($result !== null) {
                return $result;
            }

            return 0;
        }

    public function getProjectCountEmployees(Project $project): int
    {
        $result = $this->createQueryBuilder('p')
            ->select('COUNT(pe.id)')
            ->leftJoin('p.employees', 'pe')
            ->andWhere('p.id = :id')
            ->setParameter('id', $project->getId())
            ->getQuery()
            ->getSingleScalarResult()
        ;

        if ($result !== null) {
            return $result;
        }

        return 0;
    }

    //    /**
    //     * @return Project[] Returns an array of Project objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Project
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
