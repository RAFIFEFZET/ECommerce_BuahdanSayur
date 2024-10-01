@extends('dashboard.master')
@section('title','Sayur Dan Buah')
@section('nav')
    @include('dashboard.nav')
@endsection
<style>
    .fruite-img {
        position: relative;
    }
    
    .fruite-img img {
        transition: filter 0.3s ease;
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
    
    .fruite-img:hover img {
        filter: blur(3px);
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
                        <form method="GET" action="{{ route('allproducts.index') }}">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" name="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1" value="{{ request('search') }}">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </form> 
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3"> 
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <form method="GET" action="{{ route('allproducts.index') }}">
                                <label for="filter">Filter:</label>
                                <select name="filter" class="form-select" onchange="this.form.submit();">
                                    <option value="">All</option>
                                    <option value="Vegetables" {{ request('filter') == 'Vegetables' ? 'selected' : '' }}>Vegetable</option>
                                    <option value="Fruits" {{ request('filter') == 'Fruits' ? 'selected' : '' }}>Fruit</option>
                                    <option value="Import" {{ request('filter') == 'Import' ? 'selected' : '' }}>Import</option>
                                    <option value="discount" {{ request('filter') == 'discount' ? 'selected' : '' }}>Discounted</option>
                                </select>
                            </form>
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
                                                            <button type="submit" data-tippy-content="Add to Cart" data-placement="top" class="fa fa-cart-plus btn border border-secondary rounded px-3 py-2 text-primary add-to-cart-btn tippy-tooltip">
                                                            </button>                                                            
                                                        </form>
                                                    @else
                                                        <a href="{{ route('login') }}" data-tippy-content="Add to Cart" data-placement="top" class="fa fa-cart-plus btn border border-secondary rounded px-3 py-2 text-primary add-to-cart-btn tippy-tooltip">
                                                        </a>
                                                    @endif
                                                </div>
                                                <div>
                                                    @if(Auth::guard('web')->check())
                                                        <form action="{{ route('wishlists.store') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                            <button type="submit" data-tippy-content="Add to Wishlist" data-placement="top" class="fa fa-heart btn border border-secondary rounded px-3 py-2 text-primary add-to-cart-btn tippy-tooltip">
                                                            </button>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('login') }}" data-tippy-content="Add to Wishlist" data-placement="top" class="fa fa-heart btn border border-secondary rounded px-3 py-2 text-primary add-to-cart-btn tippy-tooltip">
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
                                    @if ($products->hasPages())
                                        @if ($products->onFirstPage())
                                            <a href="#" class="rounded">&laquo;</a>
                                        @else
                                            <a href="{{ $products->previousPageUrl() }}" class="rounded">&laquo;</a>
                                        @endif

                                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                            @if ($page == $products->currentPage())
                                                <a href="#" class="active rounded">{{ $page }}</a>
                                            @else
                                                <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                                            @endif
                                        @endforeach

                                        @if ($products->hasMorePages())
                                            <a href="{{ $products->nextPageUrl() }}" class="rounded">&raquo;</a>
                                        @else
                                            <a href="#" class="rounded">&raquo;</a>
                                        @endif
                                    @endif
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
@section('footer')
    @include('dashboard.footer')
@endsection
