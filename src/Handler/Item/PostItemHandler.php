<?php

namespace App\Handler\Item;

use App\Factory\ItemFactory;
use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\Request;

class PostItemHandler
{
    /**
     * @var ItemFactory
     */
    private $itemFactory;

    /**
     * @var ItemRepository
     */
    private $itemRepository;

    /**
     * PostMovementHandler constructor.
     * @param ItemFactory $itemFactory
     * @param ItemRepository $itemRepository
     */
    public function __construct(
        ItemFactory $itemFactory,
        ItemRepository $itemRepository
    ) {
        $this->itemFactory = $itemFactory;
        $this->itemRepository = $itemRepository;
    }

    /**
     * @param Request $request
     * @return int|null
     * @throws \Exception
     */
    public function handle(Request $request): ?int
    {
        $requestContent = $request->getContent();
        $data = json_decode($requestContent, true);

        $item = $this->itemFactory->createFromRequest($data);
        $this->itemRepository->save($item, true);

        return $item->getId();
    }
}
