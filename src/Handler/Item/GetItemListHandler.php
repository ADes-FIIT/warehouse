<?php

namespace App\Handler\Item;

use App\Entity\Item;
use App\Repository\ItemRepository;

class GetItemListHandler
{
    /**
     * @var ItemRepository
     */
    private $repository;

    /**
     * GetItemListHandler constructor.
     * @param ItemRepository $repository
     */
    public function __construct(
        ItemRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @return Item[]|null
     */
    public function handle(): ?array
    {
		return $this->repository->loadItems();
    }
}
