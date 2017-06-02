<?php
namespace App\Http\Controllers\UserArea;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * @var User
     */
    protected $user;

    public function __construct(Request $request, Response $response, ViewFactory $viewFactory, User $user)
    {
        parent::__construct($request, $response, $viewFactory);
        $this->user = $user;
    }

    public function show()
    {
        $user = $this->user->get()->random();

        return $this->response->json([
            'user' => $user
        ]);
    }

    public function like(int $userId)
    {
        $this->user->find($userId)->like();
    }
}