<?php

namespace App\Http\Controllers\Wallet;

use App\Domains\Wallet\WalletRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    private $walletRepository;

    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function index()
    {

    }
}
