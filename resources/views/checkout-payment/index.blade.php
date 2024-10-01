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
                        <th scope="col">OrderID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @if($orders->isEmpty())
                        <p>You have no unpaid orders.</p>
                        @else
                        @foreach($orders as $order)
                            @if($order->status == 'Unpaid')
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                {{ $order->id }}
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">{{ $order->customer->name }}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">
                                {{ \Carbon\Carbon::parse($order->order_date)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') }}
                            </p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">
                                {{ $order->total_amount }}
                            </p>
                        </td>                                                
                        <td>
                            <p class="mb-0 mt-4">
                                {{ $order->status }}
                            </p>
                        </td>                       
                        <td>
                            <p class="mb-0 mt-4">
                                <button data-id="{{ $order->id }}" class="pay-button fa fa-money-bill btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Pay Now</button>
                            </p>
                        </td>                      
                    </tr>
                    @endif
                    @endforeach
                    @endif 
                </tbody>
            </table>
        </div>        
    </div>
</div>
<!-- Cart Page End -->

<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.clientKey') }}"></script> 
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var payButtons = document.querySelectorAll('.pay-button');
            payButtons.forEach(function(payButton) {
                payButton.addEventListener('click', function () {
                    var paymentId = this.getAttribute('data-id');
                    fetch(`/get-snap-token/${paymentId}`)
                        .then(response => response.json())
                        .then(data => {
                            if(data.snapToken) {
                                window.snap.pay(data.snapToken, {
                                    onSuccess: function(result) {
                                        window.location.href = "{{ route('checkout.success') }}?order_id=" + paymentId;
                                    },
                                    onPending: function(result) {
                                        alert("Waiting for your payment!");
                                        console.log(result);
                                    },
                                    onError: function(result) {
                                        alert("Payment failed!");
                                        console.log(result);
                                    },
                                    onClose: function() {
                                        alert("You closed the popup without finishing the payment");
                                    }
                                });
                            } else {
                                alert("Failed to retrieve payment token!");
                            }
                        });
                });
            });
        });
        </script>


@section('footer')
    @include('dashboard.footer')
@endsection

