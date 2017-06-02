<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\View\Factory as ViewFactory;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param ViewFactory $viewFactory
     */
    public function __construct(Request $request, Response $response, ViewFactory $viewFactory)
    {
        parent::__construct($request, $response, $viewFactory);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return $this->viewFactory->make('layouts.admin-panel.dashboard');
    }
}