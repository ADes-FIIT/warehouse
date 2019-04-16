<?php

namespace App\Factory;

use App\Entity\Supplier;
use App\Repository\SupplierRepository;
use Symfony\Component\HttpFoundation\Response;

class SupplierFactory
{
    /**
     * @var SupplierRepository
     */
    private $supplierRepository;

    /**
     * SupplierFactory constructor.
     * @param SupplierRepository $supplierRepository
     */
    public function __construct(
        SupplierRepository $supplierRepository
    ) {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * @param array $data
     * @return Supplier
     * @throws \Exception
     */
    public function createFromRequest(array $data): Supplier
    {
        $supplier = new Supplier();
        try {
            $supplier->setName($data["name"]);
            $supplier->setDateSupply(new \DateTime($data["date_supply"]));
        } catch (\Exception $e) {
            throw new \Exception("Wrong request data!", Response::HTTP_BAD_REQUEST);
        }

        return $supplier;
    }
}
