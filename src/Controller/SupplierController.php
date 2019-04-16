<?php

namespace App\Controller;

use App\Handler\Supplier\DeleteSupplierHandler;
use App\Handler\Supplier\GetSupplierDetailHandler;
use App\Handler\Supplier\GetSupplierListHandler;
use App\Handler\Supplier\PostSupplierHandler;
use App\Mapper\ResponseSupplierMapper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/suppliers")
 * @SWG\Tag(name="suppliers")
 */
class SupplierController
{
    private $responseMapper;

    public function __construct(ResponseSupplierMapper $responseMapper)
    {
        $this->responseMapper = $responseMapper;
    }

    /**
     * List suppliers
     *
     * @Route("", methods={"GET"}, name="get_supplier_list")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of all suppliers",
     *     @SWG\Schema(
     *             @SWG\Property(property="data", type="array", @SWG\Items(
     *                  @SWG\Property(property="id", type="integer", example="1"),
     *                  @SWG\Property(property="name", type="string", example="Mobile phone supplier"),
     *                  @SWG\Property(property="registration_date", type="string", format="date-time",
     *                          example="2019-04-14T11:29:19.908Z"),
     *                  @SWG\Property(property="supply_date", type="string", format="date-time",
     *                          example="2019-04-14T11:29:19.908Z")
     *             )),
     *             @SWG\Property(property="status_code", type="integer", example="200")
     *      )
     * )
     *
     * @param GetSupplierListHandler $handler
     * @return JsonResponse
     */
    public function getList(GetSupplierListHandler $handler)
    {
        $data = $handler->handle();

        return new JsonResponse(
            [
                'data' => $this->responseMapper->mapIterable($data),
                'status_code' => Response::HTTP_OK,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Detail of a supplier
     *
     * @Route("/{id}", methods={"GET"}, name="get_supplier_detail", requirements={"id"="\d+"})
     *
     * @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of supplier to display detail of",
     *         type="integer",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns the detail of a supplier",
     *     @SWG\Schema(
     *             @SWG\Property(property="data", type="object",
     *                  @SWG\Property(property="id", type="integer", example="1"),
     *                  @SWG\Property(property="name", type="string", example="Mobile phone supplier"),
     *                  @SWG\Property(property="registration_date", type="string", format="date-time",
     *                          example="2019-04-14T11:29:19.908Z"),
     *                  @SWG\Property(property="supply_date", type="string", format="date-time",
     *                          example="2019-04-14T11:29:19.908Z")
     *             ),
     *             @SWG\Property(property="status_code", type="integer", example="200")
     *      )
     * )
     *
     * @param int $id
     * @param GetSupplierDetailHandler $handler
     * @return JsonResponse
     * @throws \Exception
     */
    public function getDetail(int $id, GetSupplierDetailHandler $handler)
    {
        $data = $handler->handle($id);

        return new JsonResponse(
            [
                'data' => $this->responseMapper->map($data),
                'status_code' => Response::HTTP_OK,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Create new supplier
     *
     * @Route("", methods={"POST"},name="post_supplier")
     *
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="name", type="string", example="Mobile phone supplier"),
     *              @SWG\Property(property="supply_date", type="string", format="date-time",
     *                      example="2019-04-14T11:29:19.908Z")
     *          ),
     *  ),
     * @SWG\Response(
     *     response=201,
     *     description="Returns the ID of newly created movement",
     *     @SWG\Schema(
     *             @SWG\Property(property="data", type="object",
     *                  @SWG\Property(property="id", type="integer", example="1")
     *             ),
     *             @SWG\Property(property="status_code", type="integer", example="201")
     *     )
     * )
     *
     * @SWG\Response(
     *     response=400,
     *     description="Returns error message when bad payload was sent",
     *     @SWG\Schema(
     *             @SWG\Property(property="error", type="object",
     *                  @SWG\Property(property="code", type="integer", example="400"),
     *                  @SWG\Property(property="message", type="string", example="Wrong request data!")
     *             )
     *     )
     * )
     *
     * @param Request $request
     * @param PostSupplierHandler $handler
     * @return JsonResponse
     * @throws \Exception
     */
    public function postMovement(Request $request, PostSupplierHandler $handler)
    {
        $id = $handler->handle($request);

        return new JsonResponse(
            [
                "data" => [
                    "id" => $id,
                ],
                "status_code" => Response::HTTP_CREATED,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Delete supplier
     *
     * @Route("/{id}", methods={"DELETE"},name="delete_supplier", requirements={"id"="\d+"})
     *
     * @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of supplier to delete",
     *         type="integer",
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns succes on successfull delete",
     * )
     *
     * @SWG\Response(
     *     response=400,
     *     description="Returns error message when non-existent ID was provided",
     *     @SWG\Schema(
     *             @SWG\Property(property="error", type="object",
     *                  @SWG\Property(property="code", type="integer", example="400"),
     *                  @SWG\Property(property="message", type="string", example="No such supplier exists.")
     *             )
     *     )
     * )
     *
     * @param int $id
     * @param DeleteSupplierHandler $handler
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteMovement(int $id, DeleteSupplierHandler $handler)
    {
        $handler->handle($id);

        return new JsonResponse(
            [
                "data" => [],
                "status_code" => Response::HTTP_OK,
            ],
            Response::HTTP_OK
        );
    }
}
