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
                        <th scope="col">Status</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                Order id
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">Customer name</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">
                                order date
                            </p>
                        </td>                                                
                        <td>
                            <p class="mb-0 mt-4">
                                status
                            </p>
                        </td>
                        <td>
                            total product price
                        </td>                        
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Order <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping cost</h5>
                            <div class="">
                                <p class="mb-0">6.00</p>
                            </div>
                        </div>
                        <p class="mb-0 text-end">Shipping to (customer address1).</p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total price with shipping</h5>
                        <p class="mb-0 pe-4">
                            Rp.
                        </p>
                    </div>
                    <button id="pay-button" class="fa fa-money-bill btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="submit">Pay Now</button>
                </div>
            </div>
        </div>        
    </div>
</div>
<!-- Cart Page End -->

<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-SKqBD6GCEhi7cn82"></script> 
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        // JavaScript code here
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{$snapToken}}', {
                onSuccess: function(result){
                    /* You may add your own implementation here */
                    // var orderId = result.transaction_order_id;
                    // Mengarahkan pengguna ke halaman berikutnya dengan menyertakan ID pesanan di URL
                    window.location.href = "{{ route('checkout.success') }}?order_id={{ $order->id }}";
                },
                onPending: function(result){
                    /* You may add your own implementation here */
                    alert("waiting for your payment!"); console.log(result);
                },
                onError: function(result){
                    /* You may add your own implementation here */
                    alert("payment failed!"); console.log(result);
                },
                onClose: function(){
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    });
</script>

@section('footer')
    @include('dashboard.footer')
@endsection

