@extends('admin.master')
@section('nav')
    @include('admin.nav')
@endsection

@section('page-title', 'Payments')
@section('page', 'Payments')
@section('main')
    @include('admin.main')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Payments</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('payments.index') }}" method="GET" class="mb-3">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center justify-content-end" style="max-width: 300px;">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control border-1" placeholder="Search..." aria-label="Search" value="{{ request()->query('search') }}">
                                    <span class="input-group-text text-body border-1" style="background-color: #596cff">
                                        <button type="submit" class="btn btn-link p-0" style="color: #fff"><i class="fas fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </form>

                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Order ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Payment Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Payment Method</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Payment Amount</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $idx => $data)
                                    <tr>
                                        <td>{{ $payments->firstItem() + $idx }}</td>
                                        <td>{{ $data->order_id }}</td>
                                        <td>{{ $data->payment_date }}</td>                                                                                                                                                                                                                                                                                      
                                        <td>{{ $data->payment_method }}</td>                                                                                                                                                                                                                                                                                      
                                        <td>{{ $data->amount }}</td>                                                                                                                                                                                                                                                                                      
                                        <td class="align-middle text-center text-sm">
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="badge badge-sm bg-gradient-danger delete-btn" data-id="{{ $data->id }}">Delete</button>
                                            </div>
                                        </td>                                            
                                    </tr>
                                @endforeach
                            </tbody>                                
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-5">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-end">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <!-- Tautan navigasi halaman -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $payments->previousPageUrl() }}" tabindex="-1" {{ $payments->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                        <i class="fa fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($page = 1; $page <= $payments->lastPage(); $page++)
                                    <li class="page-item {{ $page == $payments->currentPage() ? 'active' : '' }}" aria-current="page">
                                        <a style="color: #344767" class="page-link" href="{{ $payments->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ !$payments->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $payments->nextPageUrl() }}">
                                        <i class="fa fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <input type="hidden" id="status" value="{{ session('status') }}">
    <input type="hidden" id="message" value="{{ session('message') }}">

    <script>
        const status = document.getElementById('status').value;
        const message = document.getElementById('message').value;
    
        if (status === 'success' && message) {
            swal("Success!", message, "success");
        }
    </script>
    

    <script>
        // Get all delete buttons
        const deleteButtons = document.querySelectorAll('.delete-btn');
    
        // Attach click event listener to each delete button
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                
                // Show confirmation dialog
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this category!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    // If user confirms deletion
                    if (willDelete) {
                        // Submit the delete form
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ url('product_categories') }}/${categoryId}`;
                        form.innerHTML = `
                            @csrf
                            @method('DELETE')
                        `;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
           
@endsection
