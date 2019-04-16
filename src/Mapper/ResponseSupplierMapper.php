<?php

namespace App\Mapper;

use App\Entity\Supplier;

class ResponseSupplierMapper
{
    /**
     * @param Supplier $supplier
     * @return array
     */
    public function map(Supplier $supplier)
    {
        return [
            "id" => $supplier->getId(),
            "name" => $supplier->getName(),
            "registration_date" => $supplier->getDateRegistration()->format(DATE_RFC3339),
            "supply_date" => $supplier->getDateSupply()->format(DATE_RFC3339),
        ];
    }

    /**
     * @param array $suppliers
     * @return array
     */
    public function mapIterable(array $suppliers)
    {
        $result = [];

        foreach ($suppliers as $supplier) {
            $result[] = $this->map($supplier);
        }

        return $result;
    }
}
