<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanStoreRequest;
use App\Http\Requests\PlanUpdateRequest;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use Stripe\Stripe;
use Stripe\Plan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PlansController extends Controller
{
    /**
     * @var Stripe
     */
    protected $stripe;

    /**
     * @var Plan
     */
    protected $plan;

    /**
     * @var array
     */
    protected $currencies = [
       'usd', 'pln'
    ];

    /**
     * @var array
     */
    protected $intervals = [
          'day' => 'Day',
          'week' => 'Week',
          'month' => 'Month',
          'year' => 'Year',
    ];

    /**
     * PlansController constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param ViewFactory $viewFactory
     * @param Stripe $stripe
     * @param Plan $plan
     */
    public function __construct(Request $request, Response $response, ViewFactory $viewFactory, Stripe $stripe, Plan $plan)
    {
        parent::__construct($request, $response, $viewFactory);
        $this->stripe = $stripe;
        $this->plan = $plan;

        $this->stripe->setApiKey(env('STRIPE_SECRET'));

        $this->viewFactory->share([
            'currencies' => $this->currencies,
            'intervals' => $this->intervals
        ]);
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $plans = $this->plan->all();

        return view('admin-panel.plans.index', compact('plans'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin-panel.plans.form');
    }

    /**
     * @param PlanStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(PlanStoreRequest $request): RedirectResponse
    {
        $this->plan->create($request->except(['_token']));

        return redirect('dashboard/plans')->with('success', 'Plan was successfully created');
    }

    /**
     * @param string $id
     *
     * @return View
     */
    public function edit(string $id): View
    {
        $plan = $this->plan->retrieve($id);

        return view('admin-panel.plans.form', compact('plan'));
    }

    /**
     * @param PlanUpdateRequest $request
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function update(PlanUpdateRequest $request, string $id): RedirectResponse
    {
        $plan = $this->plan->retrieve($id);
        $plan->name = $request->get('name');
        $plan->trial_period_days = $request->get('trial_period_days');
        $plan->save();

        return redirect('dashboard/plans')->with('success', 'Plan was successfully updated');
    }

    /**
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $plan = $this->plan->retrieve($id);
        $plan->delete();

        return redirect('dashboard/plans')->with('success', 'Plan was successfully deleted');
    }
}