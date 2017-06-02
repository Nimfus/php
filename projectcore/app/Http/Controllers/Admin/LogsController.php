<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class LogsController extends Controller
{
    /**
     * @var Storage
     */
    protected $storage;

    /**
     * LogsController constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param ViewFactory $viewFactory
     * @param Storage $storage
     */
    public function __construct(Request $request, Response $response, ViewFactory $viewFactory, Storage $storage)
    {
        parent::__construct($request, $response, $viewFactory);
        $this->storage = $storage;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $logs = array_diff($this->storage->disk('logs')->allFiles(), ['.gitignore', '.hgighore']);

        return $this->viewFactory->make('admin-panel.logs.index', compact('logs'));
    }

    /**
     * @param string $filename
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show(string $filename)
    {
        return $this->response->download(storage_path('logs') . '/' . $filename);
    }

    /**
     * @param string $filename
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $filename)
    {
        $this->storage->disk('logs')->delete($filename);

        return redirect('dashboard/logs')->with('success', 'Log file successfully deleted');
    }
}