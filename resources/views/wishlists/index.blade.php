@extends('dashboard.master')
@section('title','Sayur Dan Buah')
@section('nav')
    @include('dashboard.nav')
@endsection

<style>

    .add-to-cart-btn {
        margin-left: 1rem !important;
    }
</style>


<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Wishlist</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Wishlist</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @if(Auth::guard('web')->check() && Auth::guard('web')->user()->wishlists)
                    @foreach(Auth::guard('web')->user()->wishlists as $wishlist)
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src="{{ $wishlist->product->image1_url }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">{{ $wishlist->product->product_name }}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">
                                @if($wishlist->product->discounts->isNotEmpty() && $wishlist->product->discounts->first()->end_date > now()->timezone('Asia/Jakarta'))
                                    @php
                                        $discountedPrice = $wishlist->product->price - ($wishlist->product->price * ($wishlist->product->discounts->first()->percentage / 100));
                                    @endphp
                                    <span class="text-danger text-decoration-line-through">Rp. {{ number_format($wishlist->product->price, 0, ',', '.') }}/Kg</span>
                                    <span class="fw-bold me-2">Rp. {{ number_format($discountedPrice, 0, ',', '.') }}/Kg</span>
                                    <div class="d-flex justify-content-between align-items-center position-absolute" style="top: 10px; right: 10px;">
                                        <div class="text-white bg-secondary px-3 py-1 rounded">{{ $wishlist->product->discounts->first()->percentage }}% off</div>
                                    </div>
                                @else
                                    Rp. {{ number_format($wishlist->product->price, 0, ',', '.') }}/Kg
                                @endif
                            </p>
                        </td>                                                
                        <td>
                            <div class="d-flex">
                                <div class="mr-4">
                                    <form action="{{ route('wishlists.destroy', $wishlist->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4 delete-button">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="add-to-cart ml-4">
                                    @if(Auth::guard('web')->check())
                                        <form action="{{ route('carts.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                                            <input type="hidden" name="quantity" value="1" id="quantity-input">
                                            <button type="submit" class="btn border border-secondary rounded-pill mt-3 px-3 py-2 text-primary add-to-cart-btn">
                                                <i class="fa fa-cart-plus me-2 text-primary"></i> Add to cart
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="btn border border-secondary rounded-pill mt-3 px-3 py-2 text-primary add-to-cart-btn">
                                            <i class="fa fa-cart-plus me-2 text-primary"></i> Add to cart
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </td>    
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="5">No wishlist available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Cart Page End -->
@section('footer')
    @include('dashboard.footer')
@endsection

