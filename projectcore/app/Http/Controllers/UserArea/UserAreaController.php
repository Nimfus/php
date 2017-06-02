<?php
namespace App\Http\Controllers\UserArea;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use App\Models\User;

class UserAreaController extends Controller
{
    protected $user;

    public function __construct(Request $request, Response $response, ViewFactory $viewFactory, User $user)
    {
        parent::__construct($request, $response, $viewFactory);
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->withAvatar()->get()->take(10);

        return $this->viewFactory->make('user-area.index', compact('users'));
    }
}