<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class GenericResponseEntity implements Responsable
{
    /**
     * @var bool
     */
    public $success = false;

    /**
     * @var array|mixed
     */
    public $data;

    /**
     * @var int
     */
    public $statusCode;

    /**
     * @var string
     */
    public $messages = 'Process Done';

    /**
     * @param $request
     * @return JsonResponse
     */
    public function toResponse($request)
    {
        if ($this->success) {
            $this->statusCode = $this->statusCode ?? 200;
            return new JsonResponse($this, $this->statusCode);
        }

        $this->statusCode = $this->statusCode ?? 400;
        return new JsonResponse($this, $this->statusCode);
    }
}
