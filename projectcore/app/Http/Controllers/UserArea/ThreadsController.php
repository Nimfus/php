<?php
namespace App\Http\Controllers\UserArea;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use App\Services\ChatService;
use App\Models\User;
use App\Models\Thread;

class ThreadsController extends Controller
{
    /**
     * @var ChatService
     */
    protected $chatService;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Thread
     */
    protected $thread;

    /**
     * ThreadsController constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param ViewFactory $viewFactory
     * @param ChatService $chatService
     * @param User $user
     * @param Thread $thread
     */
    public function __construct(
        Request $request,
        Response $response,
        ViewFactory $viewFactory,
        ChatService $chatService,
        User $user,
        Thread $thread
    ) {
        parent::__construct($request, $response, $viewFactory);
        $this->chatService = $chatService;
        $this->user = $user;
        $this->thread = $thread;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $threads = auth()->user()->threads()->with('users')->get();
        $userIds = $this->chatService->extractUserIds($threads, auth()->user()->id);
        $users = $this->user->byMultiIds($userIds)->with('threads')
            ->get(['id', 'name', 'avatar']);
        $preparedUsers = $this->chatService->prepareUserThreads($users);

        return $this->response->json([
            'users' => $preparedUsers,
            'threads' => $threads
        ]);
    }

    /**
     * @param int $userId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(int $userId)
    {
        $thread = $this->thread
            ->where('thread_id', $this->chatService->getThreadIdentifier(auth()->user()->id, $userId))
            ->first();
        if (!$thread) {
            $thread = $this->thread->create([
                'thread_id' => $this->chatService->getThreadIdentifier(auth()->user()->id, $userId)
            ]);
            $thread->users()->attach(auth()->user()->id);
            $thread->users()->attach($userId);
        }

        $user = $this->chatService->prepareSingleUserThreads($this->user->find($userId, ['id', 'name', 'avatar']));
        $messages = $thread->messages()->orderBy('id', 'asc')->get();

        return $this->response->json([
            'user' => $user,
            'messages' => $messages
        ]);
    }
}