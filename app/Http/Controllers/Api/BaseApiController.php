<?php

namespace App\Http\Controllers\Api;

use App\Entities\GenericResponseEntity;
use App\Http\Controllers\Controller;

/**
 *  base controller for api
 */
abstract class BaseApiController extends Controller
{
    /**
     * response object
     * @var GenericResponseEntity
     */
    protected $response;

    /**
     *  constructor
     */
    public function __construct()
    {
        $this->response = new GenericResponseEntity();
    }
}
