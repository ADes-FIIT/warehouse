<?php

namespace App\Handler\Movement;

use App\Entity\Movement;
use App\Repository\MovementRepository;

class GetMovementListHandler
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
     * @return Movement[]|null
     */
    public function handle(): ?array
    {
		return $this->repository->loadMovements();
    }
}
