@extends('layouts.app')

@section('content')
    <div class="card card-body mb-3">
        <div class="row">
            <div class="col-md-7">
                <form action="{{ url('product/store') }}" method="post">
                    @csrf
                    <div class="mb-2 d-flex">
                        <div class="w-25">Product Name</div>
                        <input type="text" placeholder="Product Name" class="form-control" name="name" id="name" >
                    </div>
                    <div class="mb-2 d-flex">
                         <div class="w-25">Product Description</div>
                        <input type="text" placeholder="Product Description" class="form-control" name="description" id="description" >
                    </div>
                    <div class="mb-2 d-flex">
                        <div class="w-25">Image File</div>
                        <input type="file"  class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <div class="mb-2 d-flex">
                        <div class="w-25">Start Date Time</div>
                        <input type="datetime-local" class="form-control" name="start_time" id="start_time" >
                    </div>
                    <div class="mb-2 d-flex">
                        <div class="w-25">End Date Time</div>
                        <input type="datetime-local" class="form-control" name="end_time" id="end_time" >
                    </div>
                    <div class="mb-2 d-flex">
                        <div class="w-25">Start Bid</div>
                        <input type="number" class="form-control" name="start_bid" id="start_bid" value="0" >
                    </div>
                    <div class="mb-2 d-flex">
                        <div class="w-25">Minimum Bid</div>
                        <input type="number" class="form-control" name="minimum_bid" id="minimum_bid" value="0" >
                    </div>
                    <div class="my-2">
                        <button class="btn btn-primary form-control">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
