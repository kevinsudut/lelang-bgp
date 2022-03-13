<?php

namespace App\Http\Controllers\Product;

use App\Domains\Product\ProductBidHistoryRepository;
use App\Domains\Product\ProductBidSnapshotRepository;
use App\Domains\Product\ProductRepository;
use App\Domains\Wallet\WalletHistoryRepository;
use App\Domains\Wallet\WalletRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bidding\BiddingLeaderboardRequest;
use App\Http\Requests\Bidding\BiddingRequest;

class ProductBidHistoryController extends Controller
{
    private $productRepository;
    private $productBidHistoryRepository;
    private $productBidSnapshotRepository;
    private $walletRepository;
    private $walletHistoryRepository;

    public function __construct(
        ProductRepository $productRepository,
        ProductBidHistoryRepository $productBidHistoryRepository,
        ProductBidSnapshotRepository $productBidSnapshotRepository,
        WalletRepository $walletRepository,
        WalletHistoryRepository $walletHistoryRepository,
    ) {
        $this->productRepository = $productRepository;
        $this->productBidHistoryRepository = $productBidHistoryRepository;
        $this->productBidSnapshotRepository = $productBidSnapshotRepository;
        $this->walletRepository = $walletRepository;
        $this->walletHistoryRepository = $walletHistoryRepository;
    }

    public function index()
    {
    }

    public function bidding(BiddingRequest $request)
    {
        $response = [
            'success' => false,
            'message' => '',
        ];

        $productId = $request->get('product_id');
        $amount = $request->get('amount');

        $product = $this->productRepository->getById($productId);
        $lastBidding = $this->productBidHistoryRepository->getLargestBidding($productId);

        if ($lastBidding->amount <= $amount) {
            $response['message'] = "Your bidding amount can't same with last bidding amount";
            return response()->json($response);
        }

        if ($amount < $product->start_bid) {
            $response['message'] = "Your bidding amount can't less than product start bidding price";
            return response()->json($response);
        }

        if ($amount < $product->minimum_bid) {
            $response['message'] = 'Minimum increase each bidding is IDR ' . number_format($product->minimum_bid);
            return response()->json($response);
        }

        $wallet = auth()->user()->wallet;
        if ($wallet == null || $wallet->amount < $amount) {
            $response['message'] = "You don't have enough money to bidding";
            return response()->json($response);
        }

        // insert bidding history
        $history = $this->productBidHistoryRepository->bidding($productId, auth()->user()->id, $wallet->id, $amount);

        // insert bidding snapshot
        $this->productBidSnapshotRepository->insert([
            'product_bid_history_id' => $history->id,
            'user_id' => auth()->user()->id,
            'amount' => $amount,
        ]);

        // deduce wallet
        $this->walletRepository->deduct(auth()->user()->id, $amount);

        // insert wallet transaction
        $this->walletHistoryRepository->deduct($wallet->id, $amount);

        $response['success'] = true;
        $response['message'] = "Successfully bidding";

        return response()->json($response);
    }

    public function leaderboard(BiddingLeaderboardRequest $request)
    {

    }
}
