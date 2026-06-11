<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderPlacedMail extends Mailable
{
    use SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $pdf = Pdf::loadView(
            'invoice',
            ['order' => $this->order]
        );

        return $this
            ->subject('Order Placed Successfully')
            ->view('emails.order')
            ->attachData(
                $pdf->output(),
                'invoice-' . $this->order->id . '.pdf'
            );
    }
}