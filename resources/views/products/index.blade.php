@extends('admin.master')
@section('title', 'Products')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Products')
@section('main')
    @include('admin.main')
    <style>
    .img-thumbnail {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .img-thumbnail:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .img-thumbnail:not(:hover) {
          transform: scale(1); /* Mengembalikan skala gambar ke ukuran normal saat kursor meninggalkan gambar */
    }
</style>


    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="{{ route('products.create') }}"><span class="badge badge-sm bg-gradient-primary mb-3 fs-6">Add New Products</span></a>
                        <h6>Products</h6>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <form action="{{ route('products.index') }}" method="GET" class="mb-3">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product Categories</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name Product</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stock Quantity</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Images</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $idx => $data)
                                        <tr>
                                            <td>{{ $idx + 1 . ". "}}</td>
                                            <td>{{ $data->category_name }}</td>
                                            <td>{{ $data->product_name }}</td>
                                            <td>
                                                @if(strlen($data->description) > 15)
                                                    <span style="cursor: zoom-in;" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $data->description }}">
                                                        {{ substr($data->description, 0, 15) }}...
                                                    </span>
                                                @else
                                                    {{ $data->description }}
                                                @endif
                                            </td>                                            
                                            <td>{{ $data->price }}</td>
                                            <td>{{ $data->stok_quantity }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    @foreach([$data->image1_url, $data->image2_url, $data->image3_url, $data->image4_url, $data->image5_url] as $index => $image)
                                                        @if($image)
                                                            <img src="{{ asset($image) }}" class="img-thumbnail" style="max-width: 100px; margin-right: 5px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal{{ $data->id }}{{ $index }}">
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="imageModal{{ $data->id }}{{ $index }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $data->id }}{{ $index }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <img src="{{ asset($image) }}" class="img-fluid rounded mx-auto d-block" style="max-height: 75vh; max-width: 56.25vw;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>                                                                                                         
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('products.edit', $data->id) }}" class="badge badge-sm bg-gradient-success me-2">Edit</a>
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
                                <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}" tabindex="-1" {{ $products->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                        <i class="fa fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($page = 1; $page <= $products->lastPage(); $page++)
                                    <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}" aria-current="page">
                                        <a style="color: #344767" class="page-link" href="{{ $products->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}">
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
                const productId = this.getAttribute('data-id');
                
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
                        form.action = `{{ url('products') }}/${productId}`;
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
