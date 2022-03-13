<?php

namespace App\Jobs;

use App\Domains\Product\ProductRepository;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AuctionWinnerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        ProductRepository $productRepository
    ) {
        try {
            $product = $productRepository->getById($this->data);

            if ($product != null) {
                // calculate winner and refund another gopay for not winner user
            }

            Log::info("Finish AuctionWinnerJob For Product ID {$this->data}");
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
