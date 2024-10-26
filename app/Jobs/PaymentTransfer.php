<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Helpers\CityPartnerHelper;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class PaymentTransfer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $order;
    protected $data;
    public $tries = 1;

    /**
     * Create a new job instance.
     */
    public function __construct($order_id, $data)
    {
        //
        $this->order = Order::find($order_id);
        $this->data = $data;
        if (!$this->order) {
            throw new Exception("order {$order_id} not exists!");
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        CityPartnerHelper::transferOrder($this->order, $this->data);
        DB::commit();
    }
}
