<?php

namespace App\Controller;

use App\Handler\Item\DeleteItemHandler;
use App\Handler\Item\GetItemDetailHandler;
use App\Handler\Item\GetItemListHandler;
use App\Handler\Item\PostItemHandler;
use App\Mapper\ResponseItemMapper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/items")
 * @SWG\Tag(name="items")
 */
class ItemController
{
    private $responseMapper;

    public function __construct(ResponseItemMapper $responseMapper)
    {
        $this->responseMapper = $responseMapper;
    }

    /**
     * List items
     *
     * @Route("", methods={"GET"}, name="get_item_list")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of items",
     *     @SWG\Schema(
     *             @SWG\Property(property="data", type="array", @SWG\Items(
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example="1"),
     *                  @SWG\Property(property="name", type="string", example="Mobile phone"),
     *                  @SWG\Property(property="price", type="number", format="float", example="212.25"),
     *                  @SWG\Property(property="quanitity", type="integer", example="2"),
     *                  @SWG\Property(property="created", type="string", format="date-time",
     *                      example="2019-04-14T11:29:19.908Z"),
     *                  )
     *             ),
     *             @SWG\Property(property="status_code", type="integer", example="200")
     *     )
     * )
     *
     * @param GetItemListHandler $handler
     * @return JsonResponse
     */
    public function getList(GetItemListHandler $handler)
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
     * Item detail
     *
     * @Route("/{id}", methods={"GET"}, name="get_item_detail", requirements={"id"="\d+"})
     *
     * @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of item to display detail of",
     *         type="integer",
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the detail of an item",
     *     @SWG\Schema(
     *             @SWG\Property(property="data", type="object",
     *                  @SWG\Property(property="id", type="integer", example="1"),
     *                  @SWG\Property(property="name", type="string", example="Mobile phone"),
     *                  @SWG\Property(property="price", type="number", format="float", example="212.25"),
     *                  @SWG\Property(property="quanitity", type="integer", example="2"),
     *                  @SWG\Property(property="created", type="string", format="date-time",
     *                      example="2019-04-14T11:29:19.908Z"),
     *             ),
     *             @SWG\Property(property="status_code", type="integer", example="200")
     *     )
     * )
     *
     * @SWG\Response(
     *     response=400,
     *     description="Returns error message when non-existent ID was provided",
     *     @SWG\Schema(
     *             @SWG\Property(property="error", type="object",
     *                  @SWG\Property(property="code", type="integer", example="400"),
     *                  @SWG\Property(property="message", type="string", example="No such item exists.")
     *             )
     *     )
     * )
     *
     * @param int $id
     * @param GetItemDetailHandler $handler
     * @return JsonResponse
     * @throws \Exception
     */
    public function getDetail(int $id, GetItemDetailHandler $handler)
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
     * Create an item
     *
     * @Route("", methods={"POST"},name="post_item")
     *
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="name", type="string", example="Mobile phone"),
     *              @SWG\Property(property="quantity", type="integer", example="2"),
     *              @SWG\Property(property="price", type="number", format="float", example="212.25"),
     *          ),
     *  )
     *
     * @SWG\Response(
     *     response=201,
     *     description="Returns the ID of newly created item",
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
     * @param PostItemHandler $handler
     * @return JsonResponse
     * @throws \Exception
     */
    public function postMovement(Request $request, PostItemHandler $handler)
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
     * Delete item
     *
     * @Route("/{id}", methods={"DELETE"}, name="delete_item", requirements={"id"="\d+"})
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
     *                  @SWG\Property(property="message", type="string", example="No such item exists.")
     *             )
     *     )
     * )
     *
     * @param int $id
     * @param DeleteItemHandler $handler
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteItem(int $id, DeleteItemHandler $handler)
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
