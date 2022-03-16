@inject('ConvertImage', '\App\Helpers\Image\ConvertImage')
@inject('CarbonFormater', '\App\Helpers\DateTime\CarbonFormater')
@inject('PageName', '\App\Helpers\Const\PageName')

@extends('layouts.app')

@section('content')

    @if (count($products) == 0)
        @component('components.message.message')
            @slot('type', 'primary')
            @slot('heading', 'There is no product yet')
        @endcomponent
    @else
        @include('components.product.list', [
            'products' => $products,
            'source' => $PageName::HOME,
        ])
    @endif

@endsection
