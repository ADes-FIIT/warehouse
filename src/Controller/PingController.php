<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api")
 */
class PingController
{
    /**
     * Check if the application is up
     *
     * @Route("", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function ping(): JsonResponse
    {
        return new JsonResponse(
            ['time' => microtime(true)]
        );
    }
}
