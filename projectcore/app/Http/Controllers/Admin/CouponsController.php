<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponStoreRequest;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Stripe\Stripe;
use Stripe\Coupon;

class CouponsController extends Controller
{
    /**
     * @var Stripe
     */
    protected $stripe;

    /**
     * @var Coupon
     */
    protected $coupon;

    /**
     * @var array
     */
    protected $durations = ['forever', 'once', 'repeating'];

    /**
     * @var array
     */
    protected $currencies = [
        'usd', 'pln'
    ];

    /**
     * CouponsController constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param ViewFactory $viewFactory
     * @param Stripe $stripe
     * @param Coupon $coupon
     */
    public function __construct(Request $request, Response $response, ViewFactory $viewFactory, Stripe $stripe, Coupon $coupon)
    {
        parent::__construct($request, $response, $viewFactory);
        $this->stripe = $stripe;
        $this->coupon = $coupon;

        $this->stripe->setApiKey(env('STRIPE_SECRET'));

        $this->viewFactory->share([
            'currencies' => $this->currencies,
            'durations' => $this->durations,
        ]);
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $coupons = $this->coupon->all();

        return view('admin-panel.coupons.index', compact('coupons'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin-panel.coupons.form');
    }

    /**
     * @param CouponStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CouponStoreRequest $request): RedirectResponse
    {
        $this->coupon->create($request->except(['_token']));

        return redirect('dashboard/coupons')->with('success', 'Coupon was successfully created');
    }

    /**
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $coupon = $this->coupon->retrieve($id);
        $coupon->delete();

        return redirect('dashboard/coupons')->with('success', 'Coupon was successfully deleted');
    }
}