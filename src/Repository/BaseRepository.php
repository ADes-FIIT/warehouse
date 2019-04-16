<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class BaseRepository extends ServiceEntityRepository
{
    /**
     * @param object $entity
     * @param bool $flush
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($entity, bool $flush)
    {
        $this->_em->persist($entity);

        if ($flush) {
            $this->_em->flush($entity);
        }
    }

    /**
     * @param object $entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove($entity): void
    {
        $this->_em->remove($entity);
        $this->_em->flush($entity);
    }
}
