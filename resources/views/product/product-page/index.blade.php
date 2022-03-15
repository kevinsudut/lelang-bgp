@inject('ConvertImage', '\App\Helpers\Image\ConvertImage')
@inject('CarbonFormater', '\App\Helpers\DateTime\CarbonFormater')

@extends('layouts.app')

@section('content')
    <script>
        const END_TIME = "{{ $product->end_time }}"
    </script>

    <div class="p-2">
        <div class="row">
            <div class="col-md-4 mb-5">
                <img src="{{ $ConvertImage->toBase64($product->image) }}" alt="product" class="img-product">
                <h1 class="mb-0 position-relative">
                    <span class="badge bg-secondary p-2 rounded-3 position-absolute" style="right: 10px; top: -50px;">{{ "IDR " . number_format($product->start_bid) }}</span>
                </h1>
            </div>
            <div class="col-md-8 mb-5">
                <h3>{{ $product->name }}</h3>
                <hr>
                <p class="lh-base" style="text-align: justify;">
                    <span>{!! nl2br(htmlentities(Str::limit(($product->description), 300, ''))) !!}</span>
                    @if (strlen($product->description) > 300)
                        <span id="dots">...</span>
                        <span id="more" style="display:  none;">{!! nl2br(htmlentities(substr($product->description, 300))) !!}</span>
                        <span class="btn btn-link" id="btn-read-more">Read more</span>
                    @endif
                </p>
                @if ($lastbid)
                    <div class="fw-bold mb-2">Current Bid : {{ "IDR " . number_format($lastbid->amount) }} | {{ $lastbid->user->mask_name }}</div>
                    <div class="fw-bold mb-2">Total Participant : {{ $leaderboard->count_participant }}</div>
                    <div class="mb-2">
                        <button class="btn btn-sm btn-primary">View Leaderboard</button>
                    </div>
                    <div id="clock"></div>
                @else
                    <div id="clock"></div>
                    <div class="form-label fw-bold">
                        <div class="bg-info mt-3 p-1">
                            <div class="text-center text-white my-2">No available bidding for this product yet</div>
                        </div>
                    </div>
                @endif
                <!-- ketika user yang login dan user yang buat product tidak sama maka bisa bidding -->
                @can('bidding', $product)
                    <!-- bid di range start and end time -->
                    @if ($product->isAlreadyStarted())
                        <form action="{{ url('bid/bidding') }}" method="post" class="my-2" id="form-bidding">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Input your bidding price here..." min="0">
                                        <small>The minimum bidding price is the last price IDR +{{ $product->minimum_bid }}</small>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <button type="submit" class="btn btn-primary form-control">Place Bid</button>
                                </div>
                            </div>
                        </form>
                    @elseif ($product->isNotStarted())
                        <h5>This auction will be started on {{ $CarbonFormater->toGMT($product->start_time) }}</h5>
                    @endif
                @endcan
                @cannot('bidding', $product)
                    <div class="bg-danger mt-3 p-1">
                        <div class="text-center text-white my-2">This is your product, you can't bid it</div>
                    </div>
                @endcannot
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/auction.js') }}"></script>

@endsection
