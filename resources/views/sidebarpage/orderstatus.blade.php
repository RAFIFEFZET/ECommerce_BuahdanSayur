@extends('profile.sidebar')

@section('content')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5" style="background-color: #81c408;">
    <h1 class="text-center text-white display-6">Order Status</h1>
</div>
<!-- Single Page Header End -->

<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        @foreach($deliveries as $delivery)
            <div class="card shadow-0 border mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                            <p class="text-muted mb-0">Order ID: {{ $delivery->order->id }}</p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                            <p class="text-muted mb-0">Shipping Date: {{ $delivery->shipping_date }}</p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                            <p class="text-muted mb-0 small">Tracking Code: {{ $delivery->tracking_code }}</p>
                        </div>
                    </div>
                    <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-2">
                            <p class="text-muted mb-0 small">Order Status:</p>
                        </div>
                        <div class="col-md-10">
                            <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between">
                                @php
                                    $statuses = [
                                        'Menunggu Konfirmasi' => 'fas fa-box-open',
                                        'Diproses' => 'fas fa-box',
                                        'Menunggu Kurir' => 'far fa-clock',
                                        'Dikirim' => 'fas fa-shipping-fast',
                                        'Diterima' => 'fas fa-people-carry',
                                    ];
                        
                                    $completed_steps = [
                                        'Menunggu Konfirmasi' => 1,
                                        'Diproses' => 2,
                                        'Menunggu Kurir' => 3,
                                        'Dikirim' => 4,
                                        'Diterima' => 5,
                                    ];
                        
                                    $current_status_index = $completed_steps[$delivery->status];
                                @endphp
                        
                                @foreach($statuses as $status => $icon)
                                    <div class="step {{ $current_status_index >= $loop->index + 1 ? 'completed' : '' }} {{ $current_status_index == $loop->index + 1 ? 'current' : '' }}" id="step-{{ $loop->index + 1 }}">
                                        <div class="step-icon-wrap d-flex justify-content-center align-items-center">
                                            <div class="step-icon"><i class="{{ $icon }}"></i></div>
                                        </div>                                    
                                        <h4 class="step-title">{{ $status }}</h4>
                                    </div>
                                @endforeach
                            </div>
                        </div>                                                
                    </div>
                    <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-12 text-center">
                            @php
                                $disabledStatuses = ['Menunggu Konfirmasi', 'Diproses', 'Menunggu Kurir'];
                            @endphp
                            @if($delivery->status == 'Diterima')
                                <a href="{{ route('sidebarpage.reviewproduct') }}" class="confirm-button fa fa-circle-check btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase">Review Product</a>
                            @else
                                <form action="{{ route('confirm.order', $delivery->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button class="confirm-button fa fa-circle-check btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase" type="submit" {{ in_array($delivery->status, $disabledStatuses) ? 'disabled' : '' }}>Konfirmasi Pesanan Diterima</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Cart Page End -->
@endsection
