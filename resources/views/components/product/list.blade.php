@inject('PageName', '\App\Helpers\Const\PageName')

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

<div class="row">
    @foreach ($products as $product)
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card mb-4">
                <div>
                    <div class="card-img-top image-product" style="background-image: url('{{ $ConvertImage->toBase64($product->image); }}');"></div>
                    <h3 class="m-0">
                        @php
                            $text = "In Progress";
                            $class = "bg-danger";
                            $now = \Carbon\Carbon::now();
                            if (\Carbon\Carbon::parse($product->start_time)->isAfter($now)) {
                                $text = "Not Started";
                                $class = "bg-info";
                            } else if (\Carbon\Carbon::parse($product->end_time)->isBefore($now)) {
                                $text = "Done";
                                $class = "bg-success";
                            }
                        @endphp
                        <span class="badge {{ $class }} rounded-pill position-absolute" style="right: 5px; top: 5px;">{{ $text }}</span>
                    </h3>
                    <h3 class="mb-0 position-relative">
                        <span class="badge bg-secondary p-2 rounded-3 position-absolute" style="left: 5px; top: -22px;">{{ "IDR " . number_format($product->start_bid) }}</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <hr>
                    </div>
                    <div class="w-100 mb-md-0">
                        <div class="mb-2">
                            <div class="fw-bold">
                                <strong style="font-weight: bold !important">Start Time</strong>
                            </div>
                            <div>{{ $CarbonFormater->toGMT($product->start_time) }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="fw-bold">
                                <strong>End Time</strong>
                            </div>
                            <div>{{ $CarbonFormater->toGMT($product->end_time) }}</div>
                        </div>
                    </div>
                    @if ($source == $PageName::MY_PRODUCT)
                        @can('delete-product', $product)
                            <div class="position-absolute" style="right: 5px; bottom: 140px;">
                                <form action="{{ url('product/delete') }}" method="post">
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <button class="btn btn-sm btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                                        <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i>
                                    </button>
                                </form>
                            </div>
                        @endcan
                    @endif
                </div>
                <div class="card-footer">
                    <small class="text-muted">Posted by {{ $product->user->name }}</small>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    {!! $products->appends($_GET)->links() !!}
</div>
