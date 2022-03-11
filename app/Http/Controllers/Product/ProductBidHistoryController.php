<?php

namespace App\Http\Controllers\Product;

use App\Domains\Product\ProductRepository;
use App\Domains\Wallet\WalletRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
