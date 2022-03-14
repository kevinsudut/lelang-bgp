@inject('ConvertImage', '\App\Helpers\Image\ConvertImage')
@inject('CarbonFormater', '\App\Helpers\DateTime\CarbonFormater')
@inject('PageName', '\App\Helpers\Const\PageName')

@extends('layouts.app')

@section('content')

    @if (count($notifications) == 0)
        @component('components.message.message')
            @slot('type', 'primary')
            @slot('heading', 'There is no notification available yet')
        @endcomponent
    @else
        <div class="my-3">
            <form action="{{ url('notification/read-all') }}" method="post">
                @csrf
                <button class="btn btn-primary">Mark All as Read</button>
            </form>
        </div>

        <div class="row my-3">
            @foreach ($notifications as $notification)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="{{ url("notification/{$notification->id}") }}">
                        <div class="card mb-3 {{ $notification->is_read == 0 ? 'aqua' : '' }}" style="min-height: 20vh;">
                            <div class="card-body">
                                <p class="card-text">
                                    <span>{!! $notification->message !!}</span>
                                </p>
                            </div>
                            <div class="card-footer text-right">
                                {{ $CarbonFormater->toGMT($notification->created_at) }}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="float-right">{{ $notifications->links() }}</div>
    @endif

@endsection
