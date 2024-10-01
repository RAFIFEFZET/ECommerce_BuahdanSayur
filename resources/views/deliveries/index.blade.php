@extends('admin.master')
@section('nav')
    @include('admin.nav')
@endsection

@section('page-title', 'Deliveries')
@section('page', 'Deliveries')
@section('main')
    @include('admin.main')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Deliveries</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <!-- Formulir pencarian -->
                            <form action="{{ route('deliveries.index') }}" method="GET" class="mb-3">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Shipping Date</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tracking Code</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Update Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deliveries as $idx => $data)
                                        <tr>
                                            <td>{{ $deliveries->firstItem() + $idx }}</td>
                                            <td>{{ $data->order->customer->name }}</td>
                                            <td>{{ $data->shipping_date }}</td>
                                            <td>{{ $data->tracking_code }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td class="align-middle text-center text-sm">
                                                <div class="d-flex justify-content-center">
                                                    @if(Auth::guard('admin')->user()->level === 'Courier')
                                                        <form action="{{ route('deliveries.update', $data->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="Dikirim">
                                                            <button type="submit" class="badge badge-sm bg-gradient-primary">Pick up</button>
                                                        </form>
                                                    @else
                                                        <button type="button" class="badge badge-sm bg-gradient-primary me-2 edit-btn" data-id="{{ $data->id }}">Edit status order</button>
                                                    @endif
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
                                <li class="page-item {{ $deliveries->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $deliveries->previousPageUrl() }}" tabindex="-1" {{ $deliveries->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                        <i class="fa fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($page = 1; $page <= $deliveries->lastPage(); $page++)
                                    <li class="page-item {{ $page == $deliveries->currentPage() ? 'active' : '' }}" aria-current="page">
                                        <a style="color: #344767" class="page-link" href="{{ $deliveries->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ !$deliveries->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $deliveries->nextPageUrl() }}">
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

    <!-- Modal -->
    @if(Auth::guard('admin')->user()->level !== 'Courier')
        @foreach ($deliveries as $data)
        <div class="modal fade" id="editModal_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel_{{ $data->id }}">Edit Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('deliveries.update', $data->id) }}" method="post" id="frmDeliveries_{{ $data->id }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status_{{ $data->id }}">
                                    <option value="Diproses" {{ $data->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Menunggu Kurir" {{ $data->status == 'Menunggu Kurir' ? 'selected' : '' }}>Menunggu Kurir</option>
                                </select>                                                               
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn bg-gradient-success" id="save">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
        @endforeach
    @endif

    <script>
        // Get all edit buttons
        const editButtons = document.querySelectorAll('.edit-btn');
    
        // Attach click event listener to each edit button
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const deliveryId = this.getAttribute('data-id');
                const status = document.querySelector(`#status_${deliveryId}`).value.trim();
    
                // Set dropdown status value
                document.querySelector(`#status_${deliveryId}`).value = status;
    
                // Update form action URL
                document.querySelector(`#frmDeliveries_${deliveryId}`).action = `{{ url('deliveries') }}/${deliveryId}`;
    
                // Show modal
                $(`#editModal_${deliveryId}`).modal('show');
            });
        });
    
        // Script for showing success message
        const status = document.getElementById('status').value;
        const message = document.getElementById('message').value;
    
        if (status === 'success' && message) {
            swal("Success!", message, "success");
        }
    </script>    
@endsection
