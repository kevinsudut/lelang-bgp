@inject('ConvertImage', '\App\Helpers\Image\ConvertImage')
@inject('CarbonFormater', '\App\Helpers\DateTime\CarbonFormater')
@inject('PageName', '\App\Helpers\Const\PageName')

@extends('layouts.app')

@section('content')

    @include('components.product.list', [
        'products' => $products,
        'source' => $PageName::MY_BID,
    ])

@endsection
