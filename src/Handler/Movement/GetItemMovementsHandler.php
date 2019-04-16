<?php

namespace App\Handler\Movement;

use App\Entity\Movement;
use App\Repository\MovementRepository;

class GetItemMovementsHandler
{
    /**
     * @var MovementRepository
     */
    private $repository;

    /**
     * GetMovementListHandler constructor.
     * @param MovementRepository $repository
     */
    public function __construct(
        MovementRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return Movement[]|null
     */
    public function handle(int $id): ?array
    {
        $movements = $this->repository->loadByItemId($id);

        return $movements;
    }
}
