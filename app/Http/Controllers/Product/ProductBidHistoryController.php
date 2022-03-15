<?php

namespace App\Http\Controllers\Product;

use App\Domains\Product\ProductBidHistoryRepository;
use App\Domains\Product\ProductBidSnapshotRepository;
use App\Domains\Product\ProductRepository;
use App\Domains\Wallet\WalletHistoryRepository;
use App\Domains\Wallet\WalletRepository;
use App\Helpers\Const\PageName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bidding\BiddingLeaderboardRequest;
use App\Http\Requests\Bidding\BiddingRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

    public function index(Request $request)
    {
        $products = $this->productRepository->filter($request, PageName::MY_BID);

        return view('product.my-bid.index', compact('products'));
    }

    public function bidding(BiddingRequest $request)
    {
        $response = [
            'success' => false,
            'message' => '',
            'leaderboard' => null,
        ];

        $productId = $request->get('id');
        $amount = $request->get('amount');

        $product = $this->productRepository->getById($productId);
        $now = Carbon::now();

        if (Gate::denies('bidding', $product)) {
            $response['message'] = "You can't bidding your product";
            return response()->json($response);
        }

        if (Carbon::parse($product->start_time)->isAfter($now)) {
            $response['message'] = "Auction has not started";
            return response()->json($response);
        }

        if (Carbon::parse($product->end_time)->isBefore($now)) {
            $response['message'] = "Auction has ended";
            return response()->json($response);
        }

        $userBidding = $this->productBidHistoryRepository->getBiddingByUserAndProduct(auth()->user()->id, $productId);
        $lastBidding = $this->productBidHistoryRepository->getLargestBidding($productId);

        if ($lastBidding != null && $amount <= $lastBidding->amount) {
            $response['message'] = "Your bidding amount can't be the same as the current bid amount";
            return response()->json($response);
        }

        if ($lastBidding == null && $amount < $product->start_bid) {
            $response['message'] = "Your bidding amount can't be less than the product start bidding price";
            return response()->json($response);
        }

        // if already last bidding -> min = last bidding + min bid
        // othewise -> min = min bid
        if ($lastBidding != null && ($amount < $lastBidding->amount + $product->minimum_bid) || $lastBidding == null && $amount < $product->minimum_bid) {
            $response['message'] = 'Minimum increase each bidding is IDR ' . number_format($product->minimum_bid);
            return response()->json($response);
        }

        /**
         * Cut GoPay amount in the number of their bid (to deposit amount)
         * If user 001 first bid 50K it will cut 50K GoPay from their acc
         * Then user 002 next bid is 100K
         * And then user 001 re-bid with 200K, it only cuts 150K this time (total 200K)
         */

        $deductAmount = $amount - ($userBidding->amount ?? 0);
        $wallet = auth()->user()->wallet;
        if ($wallet == null || $wallet->amount < $deductAmount) {
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
        $this->walletRepository->deduct(auth()->user()->id, $deductAmount);

        // insert wallet transaction
        $this->walletHistoryRepository->deduct($wallet->id, $deductAmount);

        $response['success'] = true;
        $response['message'] = "Successfully placed your bid";
        $response['leaderboard'] = $this->getCurrentLeaderboard($product->id);

        return response()->json($response);
    }

    public function getCurrentLeaderboard($productId)
    {
        $largestbid = $this->productBidHistoryRepository->getLargestBidding($productId);
        $leaderboard = $this->productBidHistoryRepository->leaderboard($productId);

        return [
            'count_participant' => $leaderboard->count_participant,
            'amount' => "IDR " . number_format($leaderboard->max_amount),
            'user' => $largestbid->user->mask_name,
        ];
    }

    public function leaderboard(BiddingLeaderboardRequest $request)
    {
        return response()->json($this->getCurrentLeaderboard($request->get('id')));
    }
}
