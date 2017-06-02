<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\View\Factory as ViewFactory;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var ViewFactory
     */
    protected $viewFactory;

    /**
     * Controller constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param ViewFactory $viewFactory
     */
    public function __construct(Request $request, Response $response, ViewFactory $viewFactory)
    {
        $this->request = $request;
        $this->response = $response;
        $this->viewFactory = $viewFactory;
    }
}
