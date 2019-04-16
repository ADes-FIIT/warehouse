<?php

namespace App\Handler\Supplier;

use App\Entity\Supplier;
use App\Repository\SupplierRepository;
use Symfony\Component\HttpFoundation\Response;

class GetSupplierDetailHandler
{
    /**
     * @var SupplierRepository
     */
    private $repository;

    /**
     * GetSupplierDetailHandler constructor.
     * @param SupplierRepository $repository
     */
    public function __construct(SupplierRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return Supplier
     * @throws \Exception
     */
    public function handle(int $id): Supplier
    {
        $supplier = $this->repository->find($id);
        if ($supplier == null) {
            throw new \Exception("No such supplier exists.", Response::HTTP_BAD_REQUEST);
        }

        return $supplier;
    }
}
