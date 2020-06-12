<?php

namespace App\Handler\Supplier;

use App\Entity\Supplier;
use App\Repository\SupplierRepository;

class GetSupplierListHandler
{
    /**
     * @var SupplierRepository
     */
    private $repository;

    /**
     * GetMovementListHandler constructor.
     * @param SupplierRepository $repository
     */
    public function __construct(
        SupplierRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @return Supplier[]|null
     */
    public function handle(): ?array
    {
		return $this->repository->loadSuppliers();
    }
}
