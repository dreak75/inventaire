<?php

namespace App\Repository;

use App\Entity\Stuffs;
use App\Entity\StuffSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stuffs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stuffs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stuffs[]    findAll()
 * @method Stuffs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StuffsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stuffs::class);
    }


    public function findByContainerIdQuery($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.containerId = :val')
            ->setParameter('val', $value)
        //    ->orderBy('s.id', 'ASC')
       //     ->setMaxResults(10)
            ->getQuery()
        ;
    }
    
    public function findBySearchQuery($search)
    {
        $query = $this->createQueryBuilder('s');

        if ($search->getProprio()){
            $query = $query->andWhere('s.property = :proprio')
                    ->setParameter('proprio', $search->getProprio());
        }
        
        if ($search->getTxt()){
            $query = $query->andWhere('s.title LIKE :txt')
                    ->setParameter('txt', '%'.$search->getTxt().'%');
        }
        
        if ($search->getOptions()->count() > 0){
            foreach($search->getOptions() as $options){
                $query = $query->andWhere(':options MEMBER OF s.options')
                                ->setParameter('options', $options);
            }
        }
         //   ->andWhere('s.containerId = :val')
          //  ->setParameter('val', $value)
        //    ->orderBy('s.id', 'ASC')
       //     ->setMaxResults(10)
           return $query->getQuery()
        ;
    }

    // /**
    //  * @return Stuffs[] Returns an array of Stuffs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stuffs
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
