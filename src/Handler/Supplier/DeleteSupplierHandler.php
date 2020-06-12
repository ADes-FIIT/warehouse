<?php

namespace App\Handler\Supplier;

use App\Repository\SupplierRepository;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class DeleteSupplierHandler
{
    /**
     * @var SupplierRepository
     */
    private $repository;

    public function __construct(SupplierRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @throws Exception
     */
    public function handle(int $id): void
    {
        $supplier = $this->repository->find($id);
        if ($supplier === null) {
            throw new Exception("No such Supplier exists.", Response::HTTP_BAD_REQUEST);
        }
        $this->repository->remove($supplier);
    }
}
