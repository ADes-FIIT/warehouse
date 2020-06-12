<?php

namespace App\Factory;

use App\Entity\Movement;
use App\Enum\MovementEnum;
use App\Repository\ItemRepository;
use App\Repository\SupplierRepository;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class MovementFactory
{
    /**
     * @var ItemRepository
     */
    private $itemRepository;

    /**
     * @var SupplierRepository
     */
    private $supplierRepository;

    /**
     * MovementFactory constructor.
     * @param ItemRepository $itemRepository
     * @param SupplierRepository $supplierRepository
     */
    public function __construct(
        ItemRepository $itemRepository,
        SupplierRepository $supplierRepository
    ) {
        $this->itemRepository = $itemRepository;
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * @param array $data
     * @return Movement
     * @throws Exception
     */
    public function createFromRequest(array $data): Movement
    {
        $movement = new Movement();
        try {
            $item = $this->itemRepository->find($data["item_id"]);

            $supplier = $this->supplierRepository->find($data['supplier_id']);

            if ($data["direction"] === MovementEnum::IN_STRING) {
                $direction = MovementEnum::IN_INTEGER;
            } elseif ($data["direction"] === MovementEnum::OUT_STRING) {
                $direction = MovementEnum::OUT_INTEGER;
            } else {
                throw new Exception();
            }
        } catch (Exception $e) {
            throw new Exception("Wrong request data!", Response::HTTP_BAD_REQUEST);
        }

        if ($item === null) {
            throw new Exception("No such item exists!", Response::HTTP_BAD_REQUEST);
        }

        if ($supplier === null) {
            throw new Exception("No such supplier exists!", Response::HTTP_BAD_REQUEST);
        }

        $movement->setDirection($direction);
        $movement->setItem($item);
        $movement->setSupplier($supplier);

        return $movement;
    }
}
