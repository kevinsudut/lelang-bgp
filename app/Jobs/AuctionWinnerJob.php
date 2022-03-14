<?php

namespace App\Jobs;

use App\Domains\Notification\NotificationRepository;
use App\Domains\Product\ProductBidHistoryRepository;
use App\Domains\Product\ProductRepository;
use App\Domains\Wallet\WalletHistoryRepository;
use App\Domains\Wallet\WalletRepository;
use App\Models\Product\ProductBidHistory;
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
        ProductRepository $productRepository,
        ProductBidHistoryRepository $productBidHistoryRepository,
        WalletRepository $walletRepository,
        WalletHistoryRepository $walletHistoryRepository,
        NotificationRepository $notificationRepository,
    ) {
        try {
            $product = $productRepository->getById($this->data);

            if ($product != null) {
                // calculate winner and refund another gopay for not winner user
                $histories = $productBidHistoryRepository->getAllWhereSortBy(
                    ['product_id', '=', $product->id],
                    'amount',
                    'desc',
                );

                $loop = 0;

                foreach ($histories as $history) {
                    // winner
                    if ($loop == 0) {
                        $history->status = ProductBidHistory::WINNER;
                        $history->save();

                        $loop++;

                        $notificationRepository->insert([
                            'user_id' => $history->user_id,
                            'message' => "Congratulation you are the winner for auction product {$product->name}.",
                            'is_read' => 0,
                            'url' => "product/{$product->id}",
                        ]);
                        continue;
                    }

                    // change status
                    $history->status = ProductBidHistory::REFUND;
                    $history->save();

                    // refund wallet
                    $walletRepository->topup($history->user_id, $history->amount);

                    // insert wallet transaction
                    $walletHistoryRepository->refund($history->wallet_id, $history->amount);

                    $notificationRepository->insert([
                        'user_id' => $history->user_id,
                        'message' => "Sorry you are not the winner for auction product {$product->name}. The money already refund to your wallet.",
                        'is_read' => 0,
                        'url' => "product/{$product->id}",
                    ]);
                }

                $notificationRepository->insert([
                    'user_id' => $product->user_id,
                    'message' => "Auction for product {$product->name} already finished.",
                    'is_read' => 0,
                    'url' => "product/{$product->id}",
                ]);
            }

            Log::info("Finish AuctionWinnerJob For Product ID {$product->id}");
        } catch (Exception $e) {
            Log::error("AuctionWinnerJob: {$e->getMessage()}");
        }
    }
}
