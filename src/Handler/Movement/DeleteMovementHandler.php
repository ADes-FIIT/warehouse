<?php

namespace App\Handler\Movement;

use App\Repository\MovementRepository;
use Symfony\Component\HttpFoundation\Response;

class DeleteMovementHandler
{
    /**
     * @var MovementRepository
     */
    private $repository;

    public function __construct(MovementRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function handle(int $id): void
    {
        $movement = $this->repository->find($id);
        if ($movement == null) {
            throw new \Exception("No such movement exists.", Response::HTTP_BAD_REQUEST);
        }
        $this->repository->remove($movement);
    }
}
