<?php

namespace App\Repository;

use App\Entity\Supplier;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Supplier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Supplier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Supplier[]    findAll()
 * @method Supplier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupplierRepository extends BaseRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Supplier::class);
    }

    /**
     * @return Supplier[]|null
     */
    public function loadSuppliers(): ?array
    {
        return $this->findBy(array(), array('id' => 'ASC'));
    }
}
