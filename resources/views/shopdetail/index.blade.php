@extends('dashboard.master')
@section('title','Sayur Dan Buah')
@section('nav')
    @include('dashboard.nav')
@endsection
<style>
    .star-color{
        color: #ffb524 !important;
    }
    .me-3 {
    margin-right: 1rem !important;
    }
    .carousel-indicators li {
    background-color: #808080;
    }
    .carousel-indicators .active {
        background-color: #303030;
    }
    .rating .fa-star {
        cursor: pointer;
        color: #ddd;
    }
    .rating .fa-star.selected,
    .rating .fa-star:hover,
    .rating .fa-star:hover ~ .fa-star {
        color: #ffd700;
    }
</style>
<div class="container-fluid py-5 mt-5" style="margin-top: 100px !important;">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if (!empty($product['image'.$i.'_url']))
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i-1 }}" class="{{ $i === 1 ? 'active' : '' }}" aria-label="Slide {{ $i }}"></button>
                                    @endif
                                @endfor
                            </ol>
                            <div class="carousel-inner">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if (!empty($product['image'.$i.'_url']))
                                        <div class="carousel-item {{ $i === 1 ? 'active' : '' }}">
                                            <img src="{{ asset($product['image'.$i.'_url']) }}" class="d-block w-100" alt="Image{{ $i }}" style="height: 400px; object-fit: cover;">
                                        </div>
                                    @endif
                                @endfor
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-3">{{ $product->product_name }}</h4>
                        <p class="mb-3">Category: {{ $product->productCategory->category_name }}</p>
                        @if($product->discounts->isNotEmpty() && $product->discounts->first()->end_date > now())
                            @php
                                $discountedPrice = $product->price - ($product->price * ($product->discounts->first()->percentage / 100));
                            @endphp
                            <div style="display: inline-block; background-color: #FFB524; color: #fff; padding: 3px 10px; border-radius: 5px;">{{ $product->discounts->first()->percentage }}% off</div>
                            <h5 class="text-danger text-decoration-line-through fw-bold mb-3">Rp. {{ number_format($product->price, 0, ',', '.') }}</h5>
                            <h5 class="fw-bold mb-3">Rp. {{ number_format($discountedPrice, 0, ',', '.') }}</h5>
                        @else
                            <h5 class="fw-bold mb-3">Rp. {{ number_format($product->price, 0, ',', '.') }}</h5>
                        @endif
                        @php
                            $rating = $product->productReviews->avg('rating');
                        @endphp

                        <div class="d-flex mb-4">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($rating && $i <= ($rating))
                                    <i class="fa fa-star star-color"></i>
                                @else
                                    <i class="fa fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="mb-4">{{ $product->description }}</p>
                        <div class="input-group quantity mb-5" style="width: 100px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="number" name="quantity" class="form-control form-control-sm text-center border-0" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            @if(Auth::guard('web')->check())
                                <form action="{{ route('carts.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1" id="quantity-input"> <!-- Add this line -->
                                    <button type="submit" class="btn border border-secondary rounded-pill px-3 py-2 text-primary add-to-cart-btn">
                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn border border-secondary rounded-pill px-3 py-2 text-primary add-to-cart-btn">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                </a>
                            @endif
                        </div>  
                    </div>
                    <div class="col-lg-12">
                        <nav>
                            <div class="nav nav-tabs mb-3">
                                <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                    id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                    aria-controls="nav-about" aria-selected="true">Description</button>
                                <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                    id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                    aria-controls="nav-mission" aria-selected="false">Reviews</button>
                            </div>
                        </nav>
                        <div class="tab-content mb-5">
                            <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                <p>{{ $product->description }}</p>
                                <div class="px-2">
                                    <div class="row g-4">
                                        <div class="col-6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                @foreach ($review as $r)
                                    <div class="d-flex justify-content-between mb-4">
                                        <div class="d-flex">
                                            @if ($r->customer->image_profile)
                                                <img src="{{ asset($r->customer->image_profile) }}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                            @else
                                                <img src="{{ asset('img/avatar.jpg') }}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                            @endif
                                            <div>
                                                <p class="mb-2" style="font-size: 14px;">{{ $r->created_at->format('F d, Y') }}</p>
                                                <div class="d-flex align-items-center">
                                                    <h5 class="me-3 mb-0">{{ $r->customer->name }}</h5>
                                                    <div class="d-flex">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $r->rating)
                                                                <i class="fa fa-star star-color"></i>
                                                            @else
                                                                <i class="fa fa-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                                <p>{{ $r->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="tab-pane" id="nav-vision" role="tabpanel">
                                <p class="text-dark"></p>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </div>
                    {{-- @if($order->status == 'Diterima')
                        @include('sidebarpage.review_form', ['product' => $product])
                    @endif     --}}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Get the input field and buttons
// Get the input field and buttons
const inputField = document.querySelector('.quantity input');
const quantityInput = document.querySelector('#quantity-input'); // Add this line
const minusButton = document.querySelector('.btn-minus');
const plusButton = document.querySelector('.btn-plus');

// Set the initial value
let currentValue = parseInt(inputField.value);

// Add event listeners to the buttons
minusButton.addEventListener('click', () => {
    if (currentValue > 1) {
        currentValue--;
        inputField.value = currentValue;
        quantityInput.value = currentValue; // Add this line
    }
});

plusButton.addEventListener('click', () => {
    currentValue++;
    inputField.value = currentValue;
    quantityInput.value = currentValue; // Add this line
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const stars = document.querySelectorAll('.rating .fa-star');
        const ratingInput = document.querySelector('input[name="rating"]');
        let ratingSelected = false;
    
        stars.forEach(star => {
            star.addEventListener('click', () => {
                ratingSelected = true;
                const ratingValue = star.getAttribute('data-value');
                ratingInput.value = ratingValue;
    
                // Reset the color of all stars
                stars.forEach(s => s.classList.remove('selected'));
    
                // Set the color of the selected stars
                star.classList.add('selected');
                let nextStar = star.nextElementSibling;
                while (nextStar) {
                    nextStar.classList.add('selected');
                    nextStar = nextStar.nextElementSibling;
                }
            });
    
            star.addEventListener('mouseover', () => {
                stars.forEach(s => s.classList.remove('hover'));
                star.classList.add('hover');
                let nextStar = star.nextElementSibling;
                while (nextStar) {
                    nextStar.classList.add('hover');
                    nextStar = nextStar.nextElementSibling;
                }
            });
    
            star.addEventListener('mouseout', () => {
                stars.forEach(s => s.classList.remove('hover'));
            });
        });
    
        // Add event listener to the form
        const form = document.querySelector('#reviewform');
        form.addEventListener('submit', (e) => {
            if (!ratingSelected) {
                e.preventDefault();
                alert('Please select a rating.');
            }
        });
    });
</script>
@section('footer')
    @include('dashboard.footer')
@endsection            