<?php

namespace App\Factory;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\Response;

class ItemFactory
{
    /**
     * @var ItemRepository
     */
    private $itemRepository;

    /**
     * MovementFactory constructor.
     * @param ItemRepository $itemRepository
     */
    public function __construct(
        ItemRepository $itemRepository
    ) {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @param array $data
     * @return Item
     * @throws \Exception
     */
    public function createFromRequest(array $data): Item
    {
        $item = new Item();
        try {
            $item->setName($data["name"]);
            $item->setPrice($data["price"]);
            $item->setQuantity($data["quantity"]);
        } catch (\Exception $e) {
            throw new \Exception("Wrong request data!", Response::HTTP_BAD_REQUEST);
        }


        return $item;
    }
}
