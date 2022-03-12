<div class="row">
    @foreach ($products as $product)
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card mb-4">
                <div>
                    <div class="card-img-top image-product" style="background-image: url('{{ $ConvertImage->toBase64("product/tokopedia.jpg"); }}');"></div>
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
