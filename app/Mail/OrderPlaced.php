<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class OrderPlaced extends Mailable
{
public $orderItem;
use Queueable, SerializesModels;

/**
* Create a new message instance.
*
* @param  mixed  $orderItem
* @return void
*/
public function __construct($orderItem)
{
$this->orderItem = $orderItem;
}

/**
* Build the message.
*
* @return $this
*/
public function build()
{
return $this
->subject('Order Placed')
->view('customer.mails.place-order'); // Điền tên view cho nội dung email, ví dụ: 'emails.order_placed'
}
}
