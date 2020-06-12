<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

abstract class BaseRepository extends ServiceEntityRepository
{
    /**
     * @param object $entity
     * @param bool $flush
     * @throws ORMException
     * @throws OptimisticLockException
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
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove($entity): void
    {
        $this->_em->remove($entity);
        $this->_em->flush($entity);
    }
}
