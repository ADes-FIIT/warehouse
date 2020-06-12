<?php

namespace App\Handler\Movement;

use App\Enum\MovementEnum;
use App\Factory\MovementFactory;
use App\Repository\ItemRepository;
use App\Repository\MovementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostMovementHandler
{
    /**
     * @var MovementFactory
     */
    private $movementFactory;

    /**
     * @var MovementRepository
     */
    private $movementRepository;

    /**
     * @var ItemRepository
     */
    private $itemRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * PostMovementHandler constructor.
     * @param MovementFactory $movementFactory
     * @param MovementRepository $movementRepository
     * @param ItemRepository $itemRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        MovementFactory $movementFactory,
        MovementRepository $movementRepository,
        ItemRepository $itemRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->movementFactory = $movementFactory;
        $this->movementRepository = $movementRepository;
        $this->itemRepository = $itemRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Request $request
     * @return int|null
     * @throws Exception
     */
    public function handle(Request $request): ?int
    {
        $requestContent = $request->getContent();
        $data = json_decode($requestContent, true);

        $movement = $this->movementFactory->createFromRequest($data);
        $item = $this->itemRepository->find($data['item_id']);
        if ($movement->getDirection() === MovementEnum::IN_INTEGER) {
            $item->addOneQuantity();
        } else {
            if ($item->subOneQuantity() < 0) {
                throw new Exception("Item can not be moved out, quantity available is 0!", Response::HTTP_CONFLICT);
            }
        }

        try {
            $this->entityManager->beginTransaction();
            $this->itemRepository->save($item, true);
            $this->movementRepository->save($movement, true);
            $this->entityManager->commit();
        } catch (Exception $exception) {
            $this->entityManager->rollback();
            throw new Exception("Movement could not be saved.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $movement->getId();
    }
}
