<?php

namespace App\Mapper;

use App\Entity\Movement;

class ResponseMovementMapper
{
    /**
     * @param Movement $movement
     * @return array
     */
    public function map(Movement $movement)
    {
        $item = $movement->getItem();
        $supplier = $movement->getSupplier();

        return [
          "id" => $movement->getId(),
          "direction" => $movement->getDirection() == 1 ? "in" : "out",
          "item" => [
              "id" => $item->getId(),
              "name" => $item->getName(),
              "price" => $item->getPrice(),
              "quantity" => $item->getQuantity(),
          ],
          "supplier" => [
              "id" => $supplier->getId(),
              "name" => $supplier->getName(),
              "supply_date" => $supplier->getDateSupply()->format(DATE_RFC3339),
          ],
        ];
    }

    /**
     * @param array $movements
     * @return array
     */
    public function mapIterable(array $movements)
    {
        $result = [];

        foreach ($movements as $movement) {
            $result[] = $this->map($movement);
        }

        return $result;
    }
}
