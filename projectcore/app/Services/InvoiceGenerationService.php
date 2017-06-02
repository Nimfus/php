<?php
namespace App\Services;

use Barryvdh\DomPDF\PDF;
use Stripe\Invoice;
use App\Models\User;

class InvoiceGenerationService
{
    /**
     * @var PDF
     */
    protected $pdf;

    /**
     * @var User
     */
    protected $user;

    /**
     * InvoiceGenerationService constructor.
     *
     * @param User $user
     * @param PDF $pdf
     */
    public function __construct(User $user, PDF $pdf)
    {
        $this->user = $user;
        $this->pdf = $pdf;
    }

    /**
     * @param Invoice $invoice
     *
     * @return \Illuminate\Http\Response
     */
    public function generateInvoice(Invoice $invoice)
    {
        //TODO add user
        $this->pdf->loadView('pdf.invoice', ['user' => null, 'invoice' => $invoice]);

        return @$this->pdf->stream();
    }
}