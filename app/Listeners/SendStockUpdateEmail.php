<?php

namespace App\Listeners;

use App\Events\StockUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendStockUpdateEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StockUpdated $event): void
    {
        $product = $event->product;

        $message = "Stock for product '{$product->name}' has been updated from {$event->oldStock} to {$event->newStock}.";

        Mail::raw($message, function ($mail) use ($product) {
            $mail->to('ashishpndt5@gmail.com')
                 ->subject("Stock Updated: {$product->name}");
        });
    }
}
