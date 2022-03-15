@inject('ConvertImage', '\App\Helpers\Image\ConvertImage')
@inject('CarbonFormater', '\App\Helpers\DateTime\CarbonFormater')

@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 2em 4em">
        <input type="hidden" name="endtime" value="{{ $product->end_time }}">
        <div class="row">
            <div class="col-md-4">
                <img alt="product" src="{{ $ConvertImage->toBase64($product->image) }}" alt="product" style="width: 100%"/>
            </div>
            <div class="col-md-8">
                <h3>{{ $product->name }}</h3>
                    {!! \Illuminate\Support\Str::limit(($product->description), 300, '') !!}
                    @if (strlen($product->description) > 300)
                        <span id="dots">...</span>
                        <span id="more" style="display:  none;">{{ substr($product->description, 300) }}</span>
                    @endif
                <button class="btn-link" onclick="myFunc()" id="myBtn">Read more</button>
                @if ($lastbid)
                    <div class="w-25 form-label fw-bold"> Current Bid : {{$lastbid->amount}}</div>
                @else
                    <div class="w-25 form-label fw-bold"> Current Bid : 0</div>
                @endif
                <div id="clock"></div>
                <!-- ketika user yang login dan user yang buat product tidak sama maka bisa bidding -->
                @if ($product->user_id !== $user)
                    <!-- ketika tanggal sekarang lebih rendah daripada end time maka bisa bid -->
                    @if (Carbon\Carbon::parse($product->end_time)->gt(Carbon\Carbon::now()))
                        <form action="{{ url('bid/bidding') }}" method="post" id="form-bidding">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <!-- min diganti jadi highest bid + minimum bid -->
                                        <input type="number" class="form-control" name="amount" id="amount" placeholder="min. {{$lastbid->amount ?? $product->start_bid}}" min="{{$lastbid->amount ?? $product->start_bid}}"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary form-control">
                                        Place Bid
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                @else
                    <div class="form-label fw-bold text-danger"> This is your product, you can't bid it</div>
                @endif
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/auction.js') }}"></script>

@endsection
