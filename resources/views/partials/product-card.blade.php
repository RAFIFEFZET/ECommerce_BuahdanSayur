
<div class="col-md-6 col-lg-4 col-xl-3">
    <div class="rounded position-relative fruite-item d-flex flex-column">
        <div class="fruite-img">
            <img src="{{ $item->image1_url }}" class="img-fluid w-100 rounded-top card-image-size" alt="">
            <a href="{{ route('shopdetail.index', ['id' => $item->id]) }}" class="btn btn-primary detail-button">View Details</a>
        </div>
        <div class="d-flex justify-content-between align-items-center position-absolute" style="top: 10px; left: 10px;">
            <div class="text-white bg-secondary px-3 py-1 rounded">{{ $item->productCategory->category_name }}</div>
        </div>
        <div class="p-4 border border-secondary border-top-0 rounded-bottom flex-grow-1">
            <h4>{{ $item->product_name }}</h4>
            <div class="description">
                {{ \Illuminate\Support\Str::limit($item->description, 50, '...') }}
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="price">
                    @if($item->discounts->isNotEmpty() && $item->discounts->first()->end_date > now()->timezone('Asia/Jakarta'))
                        @php
                            $discountedPrice = $item->price - ($item->price * ($item->discounts->first()->percentage / 100));
                        @endphp
                        <h5 class="text-danger text-decoration-line-through">Rp. {{ number_format($item->price, 0, ',', '.') }}/Kg</h5>
                        <h5 class="fw-bold me-2">Rp. {{ number_format($discountedPrice, 0, ',', '.') }}/Kg</h5>
                        <div class="d-flex justify-content-between align-items-center position-absolute" style="top: 10px; right: 10px;">
                            <div class="text-white bg-secondary px-3 py-1 rounded">{{ $item->discounts->first()->percentage }}% off</div>
                        </div>
                    @else
                        <span>Rp. {{ number_format($item->price, 0, ',', '.') }}/Kg</span>
                    @endif
                </div>
                <div class="add-to-cart">
                    @if(Auth::guard('web')->check())
                        <form action="{{ route('carts.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="fa fa-cart-plus btn border border-secondary rounded px-3 py-2 text-primary add-to-cart-btn" data-tippy-content="Add to Cart"></button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="fa fa-cart-plus btn border border-secondary rounded px-3 py-2 text-primary add-to-cart-btn" data-tippy-content="Add to Cart"></a>
                    @endif
                </div>
                <div>
                    @if(Auth::guard('web')->check())
                        <form action="{{ route('wishlists.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                            <button type="submit" class="fa fa-heart btn border border-secondary rounded px-3 py-2 text-primary add-to-cart-btn" data-bs-toggle="tooltip" data-tippy-content="Add to Cart"></button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="fa fa-heart btn border border-secondary rounded px-3 py-2 text-primary add-to-cart-btn" data-bs-toggle="tooltip" data-tippy-content="Add to Cart"></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
