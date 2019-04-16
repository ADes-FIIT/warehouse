<?php

namespace App\Handler\Item;

use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\Response;

class DeleteItemHandler
{
    /**
     * @var ItemRepository
     */
    private $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function handle(int $id): void
    {
        $item = $this->repository->find($id);
        if ($item == null) {
            throw new \Exception("No such item exists.", Response::HTTP_BAD_REQUEST);
        }
        $this->repository->remove($item);
    }
}
