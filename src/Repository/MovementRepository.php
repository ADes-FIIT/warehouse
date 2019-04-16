<?php

namespace App\Repository;

use App\Entity\Movement;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Movement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movement[]    findAll()
 * @method Movement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovementRepository extends BaseRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Movement::class);
    }

    /**
     * @return Movement[]|null
     */
    public function loadMovements(): ?array
    {
        return $this->findBy(array(), array('id' => 'ASC'));
    }

    /**
     * @param int $id
     * @return Movement[]|null
     */
    public function loadByItemId(int $id): ?array
    {
        return $this->findBy(array('item' => $id), array('id' => 'ASC'));
    }

    // /**
    //  * @return Movement[] Returns an array of Movement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Movement
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
