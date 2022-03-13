<?php

namespace App\Http\Controllers\Product;

use App\Domains\Product\ProductRepository;
use App\Domains\Wallet\WalletRepository;
use App\Http\Controllers\Controller;
use App\Jobs\AuctionWinnerJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductBidHistoryController extends Controller
{
    private $productRepository;
    private $walletRepository;

    public function __construct(
        ProductRepository $productRepository,
        WalletRepository $walletRepository
    ) {
        $this->productRepository = $productRepository;
        $this->walletRepository = $walletRepository;
    }

    public function index()
    {
    }
}
