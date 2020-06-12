<?php

namespace App\Factory;

use App\Entity\Item;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ItemFactory
{
    /**
     * @param array $data
     * @return Item
     * @throws Exception
     */
    public function createFromRequest(array $data): Item
    {
        $item = new Item();
        try {
            $item->setName($data["name"]);
            $item->setPrice($data["price"]);
            $item->setQuantity($data["quantity"]);
        } catch (Exception $e) {
            throw new \RuntimeException("Wrong request data!", Response::HTTP_BAD_REQUEST);
        }

        return $item;
    }
}
