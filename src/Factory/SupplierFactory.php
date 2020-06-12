<?php

namespace App\Factory;

use App\Entity\Supplier;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class SupplierFactory
{
    /**
     * @param array $data
     * @return Supplier
     * @throws Exception
     */
    public function createFromRequest(array $data): Supplier
    {
        $supplier = new Supplier();
        try {
            $supplier->setName($data["name"]);
            $supplier->setDateSupply(new \DateTime($data["date_supply"]));
        } catch (Exception $e) {
            throw new Exception("Wrong request data!", Response::HTTP_BAD_REQUEST);
        }

        return $supplier;
    }
}
