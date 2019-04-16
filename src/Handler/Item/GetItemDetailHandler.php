<?php

namespace App\Handler\Item;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\Response;

class GetItemDetailHandler
{
    /**
     * @var ItemRepository
     */
    private $repository;

    /**
     * GetItemDetailHandler constructor.
     * @param ItemRepository $repository
     */
    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return Item
     * @throws \Exception
     */
    public function handle(int $id): Item
    {
        $item = $this->repository->find($id);
        if ($item == null) {
            throw new \Exception("No such item exists.", Response::HTTP_BAD_REQUEST);
        }

        return $item;
    }
}
