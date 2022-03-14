@inject('ConvertImage', '\App\Helpers\Image\ConvertImage')
@inject('CarbonFormater', '\App\Helpers\DateTime\CarbonFormater')
@inject('PageName', '\App\Helpers\Const\PageName')

@extends('layouts.app')

@section('content')
<div class="card card-body mb-3">
    <div>
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseCreate" role="button" aria-expanded="false" aria-controls="collapseCreate">Open Create Product Form</a>
    </div>
    <div class="mt-2 collapse {{ old('create') ? 'show' : '' }}" id="collapseCreate">
        <div class="row">
            <form action="{{ url('product/store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" name="create" required>
                <div class="mb-2">
                    <div class="w-25 form-label fw-bold">Product Name</div>
                    <input type="text" placeholder="Product Name" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                </div>
                <div class="mb-2">
                    <div class="w-25 form-label fw-bold">Product Description</div>
                    <textarea name="description" id="description" cols="30" rows="3" class="form-control" placeholder="Product Description">{{ old('description') }}</textarea>
                </div>
                <div class="mb-2">
                    <div class="w-25 form-label fw-bold">Image File</div>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                </div>
                <div class="mb-2">
                    <div class="w-25 form-label fw-bold">Start Date Time</div>
                    <input type="datetime-local" class="form-control" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                </div>
                <div class="mb-2">
                    <div class="w-25 form-label fw-bold">End Date Time</div>
                    <input type="datetime-local" class="form-control" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
                </div>
                <div class="mb-2">
                    <div class="w-25 form-label fw-bold">Start Bid</div>
                    <input type="number" class="form-control" name="start_bid" id="start_bid" value="{{ old('start_bid') ?? 0 }}" min="0" required>
                </div>
                <div class="mb-2">
                    <div class="w-25 form-label fw-bold">Minimum Bid</div>
                    <input type="number" class="form-control" name="minimum_bid" id="minimum_bid" value="{{ old('minimum_bid') ?? 0 }}" min="0" required>
                </div>
                <div class="my-2">
                    <button class="btn btn-primary form-control">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
    @if (count($products) == 0)
        @component('components.message.message')
            @slot('type', 'primary')
            @slot('heading', 'There is no product yet')
        @endcomponent
    @else
        @include('components.product.list', [
            'products' => $products,
            'source' => $PageName::MY_PRODUCT,
        ])
    @endif

@endsection
