<?php
namespace App\Http\Controllers\UserArea;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserArea\UserUpdateRequest;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use App\Models\User;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class UserProfileController extends Controller
{
    protected $user;

    protected $storage;

    public function __construct(Request $request, Response $response, ViewFactory $viewFactory, User $user, Storage $storage)
    {
        parent::__construct($request, $response, $viewFactory);
        $this->user = $user;
        $this->storage = $storage;
    }

    public function edit()
    {
        return $this->viewFactory->make('user-area.profile.index');
    }

    public function update(UserUpdateRequest $request)
    {
        $user = $this->user->find(auth()->user()->id);

        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = str_random(150) . '.' . $file->getClientOriginalExtension();
            $this->storage->disk('images')->putFileAs('avatars', $file, $filename);
            $user->avatar = $filename;
            $user->save();
        }

        return $this->response->json(['message' => 'Information successfully updated'], 200);
    }
}