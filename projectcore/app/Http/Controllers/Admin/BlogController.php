<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use App\Models\BlogPost;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    protected $blogPost;

    public function __construct(Request $request, Response $response, ViewFactory $viewFactory, BlogPost $blogPost)
    {
        parent::__construct($request, $response, $viewFactory);
        $this->blogPost = $blogPost;
    }

    public function index(): View
    {
        $posts = $this->blogPost->paginate(20);

        return $this->viewFactory->make('admin-panel.blog.index', compact('posts'));
    }

    public function create(): View
    {
        return $this->viewFactory->make('admin-panel.blog.form');
    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}