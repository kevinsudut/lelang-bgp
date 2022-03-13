<?php

namespace App\Http\Controllers\Wallet;

use App\Domains\Wallet\WalletHistoryRepository;
use App\Domains\Wallet\WalletRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\TopUpGoPayRequest;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    private $walletRepository;
    private $walletHistoryRepository;

    public function __construct(
        WalletRepository $walletRepository,
        WalletHistoryRepository $walletHistoryRepository,
    ) {
        $this->walletRepository = $walletRepository;
        $this->walletHistoryRepository = $walletHistoryRepository;
    }

    public function index()
    {
        return view('wallet.index');
    }

    public function topup(TopUpGoPayRequest $request)
    {
        $amount = $request->get('amount');

        $wallet = $this->walletRepository->topup(auth()->user()->id, $amount);
        $this->walletHistoryRepository->topup($wallet->id, $amount);

        return redirect()->back()->with('success', 'Successfully top up GoPay');
    }
}
