<?php

namespace App\Controller;

use App\Handler\Movement\DeleteMovementHandler;
use App\Handler\Movement\GetItemMovementsHandler;
use App\Handler\Movement\GetMovementDetailHandler;
use App\Handler\Movement\GetMovementListHandler;
use App\Handler\Movement\PostMovementHandler;
use App\Mapper\ResponseMovementMapper;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/movements")
 * @SWG\Tag(name="movements")
 */
class MovementController
{
    private $responseMapper;

    public function __construct(ResponseMovementMapper $responseMapper)
    {
        $this->responseMapper = $responseMapper;
    }

    /**
     * List movements
     *
     * @Route("", methods={"GET"}, name="get_movement_list")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of all movements",
     *     @SWG\Schema(
     *             @SWG\Property(property="data", type="array", @SWG\Items(
     *                  @SWG\Property(property="id", type="integer", example="1"),
     *                  @SWG\Property(property="direction", type="string", example="in"),
     *                  @SWG\Property(property="item", type="object",
     *                      @SWG\Property(property="id", type="integer", example="1"),
     *                      @SWG\Property(property="name", type="string", example="Mobile phone"),
     *                      @SWG\Property(property="price", type="number", format="float", example="212.25"),
     *                      @SWG\Property(property="quanitity", type="integer", example="2")
     *                  ),
     *                  @SWG\Property(property="supplier", type="object",
     *                      @SWG\Property(property="id", type="integer", example="1"),
     *                      @SWG\Property(property="name", type="string", example="Mobile phone supplier"),
     *                      @SWG\Property(property="supply_date", type="string", format="date-time",
     *                          example="2019-04-14T11:29:19.908Z")
     *                  ),
     *                  @SWG\Property(property="created", type="string", format="date-time",
     *                      example="2019-04-14T11:29:19.908Z")
     *             )),
     *             @SWG\Property(property="status_code", type="integer", example="200")
     *      )
     * )
     *
     * @param GetMovementListHandler $handler
     * @return JsonResponse
     */
    public function getList(GetMovementListHandler $handler): JsonResponse
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
     * Detail of a movement
     *
     * @Route("/{id}", methods={"GET"}, name="get_movement_detail", requirements={"id"="\d+"})
     *
     * @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of movement to display detail of",
     *         type="integer",
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the detail of an movement",
     *     @SWG\Schema(
     *             @SWG\Property(property="data", type="object",
     *                  @SWG\Property(property="id", type="integer", example="1"),
     *                  @SWG\Property(property="direction", type="string", example="in"),
     *                  @SWG\Property(property="item", type="object",
     *                      @SWG\Property(property="id", type="integer", example="1"),
     *                      @SWG\Property(property="name", type="string", example="Mobile phone"),
     *                      @SWG\Property(property="price", type="number", format="float", example="212.25"),
     *                      @SWG\Property(property="quanitity", type="integer", example="2")
     *                  ),
     *                  @SWG\Property(property="supplier", type="object",
     *                      @SWG\Property(property="id", type="integer", example="1"),
     *                      @SWG\Property(property="name", type="string", example="Mobile phone supplier"),
     *                      @SWG\Property(property="supply_date", type="string", format="date-time",
     *                          example="2019-04-14T11:29:19.908Z")
     *                  ),
     *                  @SWG\Property(property="created", type="string", format="date-time",
     *                      example="2019-04-14T11:29:19.908Z")
     *             ),
     *             @SWG\Property(property="status_code", type="integer", example="200")
     *      )
     * )
     *
     * @param int $id
     * @param GetMovementDetailHandler $handler
     * @return JsonResponse
     * @throws Exception
     */
    public function getDetail(int $id, GetMovementDetailHandler $handler): JsonResponse
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
     * Get list of momvements of a certain item
     *
     * @Route("/item/{id}", methods={"GET"}, name="get_item_movements", requirements={"id"="\d+"})
     *
     * @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of an item to display movements of",
     *         type="integer",
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of all movements",
     *     @SWG\Schema(
     *             @SWG\Property(property="data", type="array", @SWG\Items(
     *                  @SWG\Property(property="id", type="integer", example="1"),
     *                  @SWG\Property(property="direction", type="string", example="in"),
     *                  @SWG\Property(property="item", type="object",
     *                      @SWG\Property(property="id", type="integer", example="1"),
     *                      @SWG\Property(property="name", type="string", example="Mobile phone"),
     *                      @SWG\Property(property="price", type="number", format="float", example="212.25"),
     *                      @SWG\Property(property="quanitity", type="integer", example="2")
     *                  ),
     *                  @SWG\Property(property="supplier", type="object",
     *                      @SWG\Property(property="id", type="integer", example="1"),
     *                      @SWG\Property(property="name", type="string", example="Mobile phone supplier"),
     *                      @SWG\Property(property="supply_date", type="string", format="date-time",
     *                          example="2019-04-14T11:29:19.908Z")
     *                  ),
     *                  @SWG\Property(property="created", type="string", format="date-time",
     *                      example="2019-04-14T11:29:19.908Z")
     *             )),
     *             @SWG\Property(property="status_code", type="integer", example="200")
     *      )
     * )
     *
     * @param int $id
     * @param GetItemMovementsHandler $handler
     * @return JsonResponse
     */
    public function getItemMovements(int $id, GetItemMovementsHandler $handler): JsonResponse
    {
        $data = $handler->handle($id);

        return new JsonResponse(
            [
                'data' => $this->responseMapper->mapIterable($data),
                'status_code' => Response::HTTP_OK,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Create a new movement
     *
     * @Route("", methods={"POST"},name="post_movement")
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="item_id", type="string", example="1"),
     *              @SWG\Property(property="supplier_id", type="integer", example="2"),
     *              @SWG\Property(property="direction", type="string", example="in"),
     *          ),
     *  )
     *
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
     * @param PostMovementHandler $handler
     * @return JsonResponse
     * @throws Exception
     */
    public function postMovement(Request $request, PostMovementHandler $handler): JsonResponse
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
     * Delete movement
     *
     * @Route("/{id}", methods={"DELETE"}, name="delete_movement", requirements={"id"="\d+"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns success on successfull delete",
     * )
     *
     * @SWG\Response(
     *     response=400,
     *     description="Returns error message when non-existent ID was provided",
     *     @SWG\Schema(
     *             @SWG\Property(property="error", type="object",
     *                  @SWG\Property(property="code", type="integer", example="400"),
     *                  @SWG\Property(property="message", type="string", example="No such movement exists.")
     *             )
     *     )
     * )
     *
     * @param int $id
     * @param DeleteMovementHandler $handler
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteMovement(int $id, DeleteMovementHandler $handler): JsonResponse
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
