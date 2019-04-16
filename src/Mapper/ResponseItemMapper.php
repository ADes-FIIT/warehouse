<?php

namespace App\Mapper;

use App\Entity\Item;

class ResponseItemMapper
{
    /**
     * @param Item $item
     * @return array
     */
    public function map(Item $item)
    {
        return [
            "id" => $item->getId(),
            "name" => $item->getName(),
            "price" => $item->getPrice(),
            "quantity" => $item->getQuantity(),
            "created" => $item->getDateAdded()->format(DATE_RFC3339),
        ];
    }

    /**
     * @param array $items
     * @return array
     */
    public function mapIterable(array $items)
    {
        $result = [];

        foreach ($items as $item) {
            $result[] = $this->map($item);
        }

        return $result;
    }
}
