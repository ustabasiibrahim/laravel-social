<?php

namespace App\Traits;

use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait SendsApiResponse
{
    use ApiResponseHelpers;

    public function success($data = [], string $message = 'OK'): JsonResponse
    {
        return $this->respondWithSuccess([
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * @param mixed $data
     * @param string $message
     * @return JsonResponse
     */
    public function created(mixed $data = [], string $message = 'Created'): JsonResponse
    {
        return $this->respondCreated(
            ['message' => $message] + compact('data')
        );
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function deleted(string $message = 'Deleted'): JsonResponse
    {
        return $this->respondNoContent(compact('message'));
    }

    /**
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    public function error(string $message = 'Error occured when process!', array $data = []): JsonResponse
    {
        return $this->apiResponse(
            ['message' => $message, 'data' => $data],
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * @param string $url
     * @return JsonResponse
     */
    public function redirect(string $url) : JsonResponse
    {
        return $this->apiResponse(
            [
                'type' => 'redirection',
                'url' => $url,
            ],
            Response::HTTP_FOUND
        );
    }
}
