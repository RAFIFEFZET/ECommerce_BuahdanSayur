@extends('admin.master')
@section('title', 'Product Reviews')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Product Reviews')
@section('main')
    @include('admin.main')

<style>
    .star-color{
        color: #ffb524 !important;
    }
</style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        {{-- <a href="{{ route('discounts-admin.create') }}"><span class="badge badge-sm bg-gradient-primary mb-3 fs-6">Add New Discounts</span></a> --}}
                        <h6>Product Reviews</h6>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <form action="{{ route('product_reviews-admin.index') }}" method="GET" class="mb-3">
                                <div class="ms-md-auto pe-md-3 d-flex align-items-center justify-content-end" style="max-width: 300px;"> <!-- Adjust width here -->
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rating</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Comment</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productreviews as $idx => $data)
                                        <tr>
                                            <td>{{ $idx + 1 . ". "}}</td>
                                            <td>{{ $data->customer->name }}</td>
                                            <td>{{ $data->product->product_name }}</td>
                                            <td>
                                                <div class="d-flex mb-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $data->rating)
                                                            <i class="fa fa-star star-color"></i>
                                                        @else
                                                            <i class="fa fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>{{ $data->comment }}</td>                                                                                                       
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    {{-- <a href="{{ route('product_reviews-admin.edit', $data->id) }}" class="badge badge-sm bg-gradient-success me-2">Edit</a> --}}
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
        </div>

        <footer class="footer pt-5">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-end">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <!-- Tautan navigasi halaman -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item {{ $productreviews->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $productreviews->previousPageUrl() }}" tabindex="-1" {{ $productreviews->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                        <i class="fa fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($page = 1; $page <= $productreviews->lastPage(); $page++)
                                    <li class="page-item {{ $page == $productreviews->currentPage() ? 'active' : '' }}" aria-current="page">
                                        <a style="color: #344767" class="page-link" href="{{ $productreviews->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ !$productreviews->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $productreviews->nextPageUrl() }}">
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

    <input type="hidden" id="status" class="form-control" value="@isset($status){{ $status }}@endisset">
    <input type="hidden" id="pesan" class="form-control" value="@isset($pesan){{ $pesan }}@endisset">
    
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: `{!! html_entity_decode(session('success')) !!}`,
            });
        </script>
    @endif

    <script>
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productreviewsId = this.getAttribute('data-id');
                
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this product!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ url('product_reviews-admin') }}/${productreviewsId}`;
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
