<?php

namespace App\Handler\Movement;

use App\Entity\Movement;
use App\Repository\MovementRepository;
use Symfony\Component\HttpFoundation\Response;

class GetMovementDetailHandler
{
    /**
     * @var MovementRepository
     */
    private $repository;

    /**
     * GetMovementDetailHandler constructor.
     * @param MovementRepository $repository
     */
    public function __construct(MovementRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return Movement
     * @throws \Exception
     */
    public function handle(int $id): Movement
    {
        $movement = $this->repository->find($id);
        if ($movement === null) {
            throw new \Exception("No such movement exists.", Response::HTTP_BAD_REQUEST);
        }

        return $movement;
    }
}
