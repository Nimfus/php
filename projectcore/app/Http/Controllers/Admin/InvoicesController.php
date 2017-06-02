<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use Stripe\Stripe;
use Stripe\Invoice;
use Illuminate\Contracts\View\View;
use App\Services\InvoiceGenerationService;

class InvoicesController extends Controller
{
    /**
     * @var Stripe
     */
    protected $stripe;

    /**
     * @var Invoice
     */
    protected $invoice;

    /**
     * @var InvoiceGenerationService
     */
    protected $invoiceGenerationService;

    /**
     * InvoicesController constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param ViewFactory $viewFactory
     * @param Stripe $stripe
     * @param Invoice $invoice
     * @param InvoiceGenerationService $invoiceGenerationService
     */
    public function __construct(Request $request, Response $response, ViewFactory $viewFactory, Stripe $stripe, Invoice $invoice, InvoiceGenerationService $invoiceGenerationService)
    {
        parent::__construct($request, $response, $viewFactory);
        $this->stripe = $stripe;
        $this->invoice = $invoice;
        $this->invoiceGenerationService = $invoiceGenerationService;

        $this->stripe->setApiKey(env('STRIPE_SECRET'));
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $invoices = $this->invoice->all();

        return $this->viewFactory->make('admin-panel.invoices.index', compact('invoices'));
    }

    /**
     * @param string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $invoice = $this->invoice->retrieve($id);

        return $this->invoiceGenerationService->generateInvoice($invoice);
    }
}