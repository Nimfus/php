<?php
namespace App\Http\Controllers\UserArea;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserArea\MessagesIndexRequest;
use App\Http\Requests\UserArea\MessageStoreRequest;
use App\Models\Message;
use App\Models\Thread;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use App\Services\PusherService;

class MessagesController extends Controller
{
    /**
     * @var Message
     */
    protected $message;

    /**
     * @var Thread
     */
    protected $thread;

    /**
     * @var PusherService
     */
    protected $pusherService;

    protected $perPage = 50;

    /**
     * MessagesController constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param ViewFactory $viewFactory
     * @param Message $message
     * @param Thread $thread
     * @param PusherService $pusherService
     */
    public function __construct(
        Request $request,
        Response $response,
        ViewFactory $viewFactory,
        Message $message,
        Thread $thread,
        PusherService $pusherService
    ) {
        parent::__construct($request, $response, $viewFactory);
        $this->message = $message;
        $this->thread = $thread;
        $this->pusherService = $pusherService;
    }

    /**
     * @param MessagesIndexRequest $request
     * @param string $threadId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(MessagesIndexRequest $request, string $threadId)
    {
        $thread = $this->thread->where('thread_id', $threadId)->first();
        $messages = $this->message
            ->where('thread_id', $thread->id)
            ->orderBy('id', 'desc')
            ->skip(($request->get('page') - 1) *  $this->perPage)
            ->take($this->perPage)
            ->get()
            ->sortBy('id')
            ->values()
            ->all();

        return $this->response->json([
            'messages' => $messages
        ]);
    }

    /**
     * @param MessageStoreRequest $request
     */
    public function store(MessageStoreRequest $request): void
    {
        $thread = $this->thread->where('thread_id', $request->get('thread_id'))->first();

        $message = $this->message->create([
            'sender_id' => auth()->user()->id,
            'recipient_id' => $request->get('recipient_id'),
            'thread_id' => $thread->id,
            'message' => $request->get('message')
        ]);

        $this->pusherService->dispatchToPusher($thread->thread_id, $message);
    }
}