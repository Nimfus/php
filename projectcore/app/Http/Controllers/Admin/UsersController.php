<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use App\Services\PasswordHashService;
use Illuminate\Contracts\View\View;
use App\Models\Role;

class UsersController extends Controller
{
    /**
     * @var UsersRepository
     */
    protected $repository;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Role
     */
    protected $role;

    /**
     * @var PasswordHashService
     */
    protected $passwordHashService;

    /**
     * UsersController constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param ViewFactory $viewFactory
     * @param UsersRepository $usersRepository
     * @param User $user
     * @param PasswordHashService $passwordHashService
     * @param Role $role
     */
    public function __construct(
        Request $request,
        Response $response,
        ViewFactory $viewFactory,
        UsersRepository $usersRepository,
        User $user,
        PasswordHashService $passwordHashService,
        Role $role
    ) {
        parent::__construct($request, $response, $viewFactory);
        $this->repository = $usersRepository;
        $this->user = $user;
        $this->passwordHashService = $passwordHashService;
        $this->role = $role;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $users = $this->repository->paginate([]);

        return $this->viewFactory->make('admin-panel.users.index', compact('users'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $roles = $this->role->all();

        return $this->viewFactory->make('admin-panel.users.form', compact('roles'));
    }

    /**
     * @param UserStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $user = $this->user->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $this->passwordHashService->createPasswordHash($request->get('password'))
        ]);

        $user->roles()->attach($request->get('role'));

        return redirect('dashboard/users')->with('success', 'User successfully created');
    }

    /**
     * @param User $user
     *
     * @return View
     */
    public function edit(User $user): View
    {
        $roles = $this->role->all();

        return $this->viewFactory->make('admin-panel.users.form', compact('user', 'roles'));
    }

    /**
     * @param UserUpdateRequest $request
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, int $id): RedirectResponse
    {
        $user = $this->repository->findBy(['id' => $id]);
        $this->authorize('update', $user);
        $user->update($request->except('password'));
        if (!empty($request->get('password'))) {
            $user->password = $this->passwordHashService->createPasswordHash($request->get('password'));
            $user->save();
        }

        $user->roles()->detach();
        $user->roles()->attach($request->get('role'));

        return redirect('dashboard/users')->with('success', 'User successfully updated');
    }

    /**
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('destroy', $user);
        $user->delete();

        return redirect('dashboard/users')->with('success', 'User successfully deleted');
    }
}