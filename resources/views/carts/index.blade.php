@extends('dashboard.master')
@section('title','Sayur Dan Buah')
@section('nav')
    @include('dashboard.nav')
@endsection



<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
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
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @if(Auth::guard('web')->check() && Auth::guard('web')->user()->carts)
                    @foreach(Auth::guard('web')->user()->carts as $cart)
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src="{{ $cart->product->image1_url }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">{{ $cart->product->product_name }}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">
                                @if($cart->product->discounts->isNotEmpty() && $cart->product->discounts->first()->end_date > now()->timezone('Asia/Jakarta'))
                                    @php
                                        $discountedPrice = $cart->product->price - ($cart->product->price * ($cart->product->discounts->first()->percentage / 100));
                                    @endphp
                                    <span class="text-danger text-decoration-line-through">Rp. {{ number_format($cart->product->price, 0, ',', '.') }}/Kg</span>
                                    <span class="fw-bold me-2">Rp. {{ number_format($discountedPrice, 0, ',', '.') }}/Kg</span>
                                    <div class="d-flex justify-content-between align-items-center position-absolute" style="top: 10px; right: 10px;">
                                        <div class="text-white bg-secondary px-3 py-1 rounded">{{ $cart->product->discounts->first()->percentage }}% off</div>
                                    </div>
                                @else
                                    Rp. {{ number_format($cart->product->price, 0, ',', '.') }}/Kg
                                @endif
                            </p>
                        </td>                                                
                        <td>
                            <div class="input-group quantity mt-4" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="changeQuantity(this, -1)">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="number" data-rowid="{{ $cart->id }}" onchange="updateQuantity(this)" class="form-control form-control-sm text-center border-0" value="{{ $cart->quantity }}">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="changeQuantity(this, 1)">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <form id="updateCartQty-{{ $cart->id }}" action="{{route('carts.update', $cart->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="rowId-{{ $cart->id }}" name="rowId">
                            <input type="hidden" id="quantity-{{ $cart->id }}" name="quantity">
                        </form>
                        <td>
                            <p class="mb-0 mt-4">
                                @php
                                    $totalPrice = $discountedPrice ?? $cart->product->price; // If discounted price exists, use it, otherwise use regular price
                                @endphp
                                Rp. {{ number_format($totalPrice * $cart->quantity, 0, ',', '.') }}/Kg
                            </p>
                        </td>                        
                        <td>
                            <form action="{{ route('carts.destroy', $cart->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="5">No carts available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        {{-- <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
        </div> --}}
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0">
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach(Auth::guard('web')->user()->carts as $cart)
                                    @php
                                        $discountedPrice = $cart->product->price;
                                        if($cart->product->discounts->isNotEmpty() && $cart->product->discounts->first()->end_date > now()->timezone('Asia/Jakarta')) {
                                            $discountedPrice = $cart->product->price - ($cart->product->price * ($cart->product->discounts->first()->percentage / 100));
                                        }
                                        $subtotal += $discountedPrice * $cart->quantity;
                                    @endphp
                                @endforeach
                                Rp. {{ number_format($subtotal, 0, ',', '.') }}
                            </p>
                        </div>
                        {{-- <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div class="">
                                <p class="mb-0">Flat rate: 6.00</p>
                            </div>
                        </div>
                        <p class="mb-0 text-end">Shipping to Ukraine.</p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4">
                            Rp.{{ number_format($subtotal + 3, 2) }} <!-- Adding shipping fee to subtotal -->
                        </p>
                    </div> --}}
                    @if($isCartEmpty)
                        <a style="cursor: not-allowed;">
                            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button" disabled>Proceed Checkout</button>
                        </a>
                    @else
                        <a href="{{ route('checkout.index') }}">
                            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
                        </a>
                    @endif
                </div>
            </div>
        </div>        
    </div>
</div>
<!-- Cart Page End -->
<script>
    function changeQuantity(button, delta) {
    var input = $(button).parent().siblings('input');
    var newValue = parseInt(input.val()) + delta;
    if (newValue < 1) newValue = 1; // prevent quantity from going below 1
    input.val(newValue);
    updateQuantity(input[0]);
}
    function updateQuantity(qty) {
        var rowId = $(qty).data('rowid');
        $('#rowId-' + rowId).val(rowId);
        $('#quantity-' + rowId).val($(qty).val());
        $('#updateCartQty-' + rowId).submit();
    }
</script>
@section('footer')
    @include('dashboard.footer')
@endsection

