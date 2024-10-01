@extends('dashboard.master')
@section('title','Sayur Dan Buah')
@section('nav')
    @include('dashboard.nav')
@endsection

<style>
    .fruite-img {
        position: relative;
    }
    
    .detail-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .fruite-img:hover .detail-button {
        opacity: 1;
    }
    .card-image-size {
        width: 300px;
        height: 250px;
        object-fit: cover;
    }
    .add-to-cart-btn {
        margin-right: 0.3rem !important;    
    }
</style>
<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Fresh fruits shop</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="fruits">Default Sorting:</label>
                            <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                <option value="volvo">Nothing</option>
                                <option value="saab">Popularity</option>
                                <option value="opel">Organic</option>
                                <option value="audi">Fantastic</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                            </div>
                            {{-- <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4 class="mb-2">Price</h4>
                                    <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500" value="0" oninput="amount.value=rangeInput.value">
                                    <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                                </div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="position-relative">
                                    <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                    <div class="position-absolute" style="top: 100%; right: 10px; transform: translateY(-50%);">
                                        <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            <!-- Loop through products here -->
                            @foreach($products as $item)
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="rounded position-relative fruite-item d-flex flex-column"> <!-- Add d-flex flex-column here -->
                                        <div class="fruite-img">
                                            <img src="{{ $item->image1_url }}" class="img-fluid w-100 rounded-top card-image-size" alt="">
                                            <a href="{{ route('shopdetail.index', ['id' => $item->id]) }}" class="btn btn-primary detail-button">View Details</a>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center position-absolute" style="top: 10px; left: 10px;">
                                            <div class="text-white bg-secondary px-3 py-1 rounded">{{ $item->productCategory->category_name }}</div>
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom flex-grow-1"> <!-- Add flex-grow-1 here -->
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
                                                <!-- Add to cart button -->
                                                <div class="add-to-cart">
                                                    @if(Auth::guard('web')->check())
                                                        <form action="{{ route('carts.store') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                            <input type="hidden" name="quantity" value="1">
                                                            <button type="submit" class="fa fa-cart-plus btn border border-secondary rounded px-3 py-2 text-primary add-to-cart-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to cart">
                                                            </button>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('login') }}" class="fa fa-cart-plus btn border border-secondary rounded px-3 py-2 text-primary add-to-cart-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to cart">
                                                        </a>
                                                    @endif
                                                </div>
                                                <div>
                                                    @if(Auth::guard('web')->check())
                                                        <form action="{{ route('wishlists.store') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                            <button type="submit" class="fa fa-heart btn border border-secondary rounded px-3 py-2 text-primary add-to-cart-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to wishlist">
                                                            </button>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('login') }}" class="fa fa-heart btn border border-secondary rounded px-3 py-2 text-primary add-to-cart-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to wishlist">
                                                        </a>
                                                    @endif
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12">
                                <div class="pagination d-flex justify-content-center mt-5">
                                    <a href="#" class="rounded">&laquo;</a>
                                    <a href="#" class="active rounded">1</a>
                                    <a href="#" class="rounded">2</a>
                                    <a href="#" class="rounded">3</a>
                                    <a href="#" class="rounded">4</a>
                                    <a href="#" class="rounded">5</a>
                                    <a href="#" class="rounded">6</a>
                                    <a href="#" class="rounded">&raquo;</a>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End--> 
<script>
    $(function () {
      $('[data-bs-toggle="tooltip"]').tooltip()
    })
</script>
@section('footer')
    @include('dashboard.footer')
@endsection