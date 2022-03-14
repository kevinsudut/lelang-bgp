@inject('ConvertImage', '\App\Helpers\Image\ConvertImage')
@inject('CarbonFormater', '\App\Helpers\DateTime\CarbonFormater')

@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 2em 4em">
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
                <button class="btn btn-link btn-small" onclick="myFunc()" id="myBtn">Read more</button>
                <h4>Current Bid: Rp 10.000.000,- by Ind** Ke****</h4>
                <h5>Time left: 6d 10h | Sun, 11:30am</h5>
                <br/>
                <form action="#" id="form-bidding">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" class="form-control" id="amount" placeholder="e.g. 10000"/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">
                                Place Bid
                            </button>
                        </div>
                    </div>
                </form>
                <br/>
                <p>
                    1000 bids
                </p>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/auction.js') }}"></script>
    <script src="{{ asset('js/auction.js') }}"></script>

@endsection
