@extends('profile.sidebar')

@section('content')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5" style="background-color: #81c408;">
    <h1 class="text-center text-white display-6">Review Product</h1>
</div>
<!-- Single Page Header End -->

<!-- Review Product Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        @foreach($productsToReview as $product)
            <div class="card shadow-0 border mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $product->image1_url }}" class="img-fluid rounded-start product-image" alt="Product Image">
                        </div>                        
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->product_name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <form id="reviewform_{{ $product->id }}" action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="mb-3">
                                        <input name="name" type="text" class="form-control" placeholder="Your Name *" value="{{ Auth::check() ? Auth::user()->name : '' }}" readonly required>
                                    </div>
                                    <div class="mb-3">
                                        <input name="email" type="email" class="form-control" placeholder="Your Email *" value="{{ Auth::check() ? Auth::user()->email : '' }}" readonly required>
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="comment" class="form-control" rows="3" placeholder="Your Review *" spellcheck="false" required></textarea>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="rating" style="font-size: 24px; direction: rtl;">
                                            <i class="fa fa-star" data-value="5"></i>
                                            <i class="fa fa-star" data-value="4"></i>
                                            <i class="fa fa-star" data-value="3"></i>
                                            <i class="fa fa-star" data-value="2"></i>
                                            <i class="fa fa-star" data-value="1"></i>
                                        </div>
                                        <input type="text" name="rating" value="" required style="display: none;">
                                        <button type="submit" class="btn btn-primary">Post Comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if (empty($productsToReview))
            <p class="text-center">Anda tidak memiliki produk untuk direview saat ini.</p>
        @endif
    </div>
</div>
<!-- Review Product End -->

@endsection
