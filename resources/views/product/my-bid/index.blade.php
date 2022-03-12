@inject('ConvertImage', '\App\Helpers\Image\ConvertImage')
@inject('CarbonFormater', '\App\Helpers\DateTime\CarbonFormater')

@extends('layouts.app')

@section('content')
    <div class="card card-body mb-3">
        <form action="" method="get">
            <div class="row g-3 align-items-center">
                <div class="col-md-3">
                    <label for="" class="form-label fw-bold">Start Time</label>
                    <input type="datetime-local" class="form-control" name="start_time" id="end-time" value="{{ request()->get('start_time') ?? '' }}">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label fw-bold">End Time</label>
                    <input type="datetime-local" class="form-control" name="end_time" id="end-time" value="{{ request()->get('end_time') ?? '' }}">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label fw-bold">Minimum Bid</label>
                    <input type="number" class="form-control" name="minimum_bid" id="minimum-bid" min="0" value="{{ request()->get('minimum_bid') ?? 0 }}">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label fw-bold">Maximum Bid</label>
                    <input type="number" class="form-control" name="maximum_bid" id="maximum-bid" min="0" value="{{ request()->get('maximum_bid') ?? 0 }}">
                </div>
            </div>
            <div class="my-2">
                <button class="btn btn-primary form-control">Filter Product</button>
            </div>
        </form>
    </div>

    @include('components.product.list', ['products' => $products])

@endsection
