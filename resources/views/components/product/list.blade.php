<div class="row">
    @foreach ($products as $product)
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card mb-4">
                <img class="card-img-top img-card" src="{{ $product->image }}" alt="product">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text" title="{{ $product->name }}">
                        {{ Str::limit(ucwords(strtolower($product->description)), 16, '...') }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
