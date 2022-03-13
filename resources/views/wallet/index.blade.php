@inject('ConvertImage', '\App\Helpers\Image\ConvertImage')
@inject('CarbonFormater', '\App\Helpers\DateTime\CarbonFormater')

@extends('layouts.app')

@section('content')
    @php
        $wallet = auth()->user()->wallet;
        $histories = $wallet->walletHistories ?? [];
    @endphp
    <div class="card card-body mb-3">
        <div class="row">
            <div class="col-md-6 mb-3" style="min-height: 100px;">
                <div class="gopay-amount-container text-center">
                    <h1 class="m-0 gopay-amount">{{ $wallet->ammountFormat ?? "IDR 0" }}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <form action="{{ url('wallet/topup') }}" method="post">
                    @csrf
                    <div class="mb-0">
                        <input type="number" class="form-control" name="amount" id="amount" value="0" min="10000">
                        <div class="form-text">Minimum top up IDR 10.000</div>
                    </div>
                    <div class="my-2">
                        <button class="btn btn-primary form-control">Top Up GoPay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($wallet != null && count($histories) > 0)
        <div class="px-lg-5">
            <h2 class="m-0">Wallet transaction history</h2>
            <small>Only show last 30 transactions</small>
            <hr class="mb-0">
            <div class="gopay-transaction-container">
                @foreach ($histories->take(30) as $history)
                    <ol class="list-group">
                        <li class="list-group-item border-0 border-bottom d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <h4 class="fw-bold mt-2">{{ $history->typeStr() }}</h4>
                                <span>Transaction on {{ $CarbonFormater->toGMT($history->created_at) }}</span>
                            </div>
                            <h5>
                                <span class="badge {{ $history->typeCss() }} p-2 rounded-3">{{ $history->amountFormat ?? "IDR 0" }}</span>
                            </h5>
                        </li>
                    </ol>
                @endforeach
            </div>
        </div>
    @else
        @component('components.message.message')
            @slot('type', 'primary')
            @slot('heading', 'There is no wallet transaction history yet')
        @endcomponent
    @endif

@endsection
