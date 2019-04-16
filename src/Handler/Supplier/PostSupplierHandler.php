<?php

namespace App\Handler\Supplier;

use App\Factory\SupplierFactory;
use App\Repository\SupplierRepository;
use Symfony\Component\HttpFoundation\Request;

class PostSupplierHandler
{
    /**
     * @var SupplierFactory
     */
    private $supplierFactory;

    /**
     * @var SupplierRepository
     */
    private $supplierRepository;

    /**
     * PostMovementHandler constructor.
     * @param SupplierFactory $supplierFactory
     * @param SupplierRepository $supplierRepository
     */
    public function __construct(
        SupplierFactory $supplierFactory,
        SupplierRepository $supplierRepository
    ) {
        $this->supplierFactory = $supplierFactory;
        $this->supplierRepository = $supplierRepository;
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

        $supplier = $this->supplierFactory->createFromRequest($data);
        $this->supplierRepository->save($supplier, true);

        return $supplier->getId();
    }
}
