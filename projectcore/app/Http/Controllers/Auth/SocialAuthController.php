<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use Laravel\Socialite\Facades\Socialite;
use App\Services\SocialAccountService;

class SocialAuthController extends Controller
{
    /**
     * @var SocialAccountService
     */
    protected $socialAccountService;

    /**
     * SocialAuthController constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param ViewFactory $viewFactory
     * @param SocialAccountService $socialAccountService
     */
    public function __construct(Request $request, Response $response, ViewFactory $viewFactory, SocialAccountService $socialAccountService)
    {
        parent::__construct($request, $response, $viewFactory);
        $this->socialAccountService = $socialAccountService;
    }

    /**
     * @return mixed
     */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callback()
    {
        $user = $this->socialAccountService->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

        return redirect('/');
    }
}