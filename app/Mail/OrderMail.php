<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\SubscriptionPlan;
use App\Models\User;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public $customer;
    public SubscriptionPlan $plan;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $customer, $plan)
    {
        $this->order = $order;
        $this->customer = $customer;
        $this->plan = $plan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $order = $this->order;
        $plan = $this->plan;
        $customer = $this->customer;
        return new Content(
            view: 'pages.orders.mail',
            with: ['order', 'customer', 'plan']
        );

        return $this->subject('Order Confirmation')->view('mails.order-mail');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
