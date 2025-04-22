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
                                                        @if($data->status === 'Menunggu Kurir')
                                                            <form action="{{ route('deliveries.update', $data->id) }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="Dikirim">
                                                                <button type="submit" class="badge badge-sm bg-gradient-primary">Pick up</button>
                                                            </form>
                                                        @elseif($data->status === 'Dikirim')
                                                            @if(is_null($data->courier_proof))
                                                                <button type="button" class="badge badge-sm bg-gradient-success ambil-foto-btn" data-id="{{ $data->id }}">Ambil Foto Bukti</button>
                                                            @else
                                                                <button type="button" class="badge badge-sm bg-gradient-secondary" disabled>Foto Sudah diambil</button>
                                                            @endif
                                                        @endif
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

    @if(Auth::guard('admin')->user()->level === 'Courier')
    <div class="modal fade" id="ambilFotoModal" tabindex="-1" role="dialog" aria-labelledby="ambilFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="frmAmbilFoto" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ambilFotoModalLabel">Ambil Foto Bukti</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <!-- Pilihan metode: Upload atau Ambil Langsung -->
            <ul class="nav nav-pills mb-3" id="photoOptionsTab" role="tablist">
                <li class="nav-item" role="presentation">
                <button class="nav-link active" id="upload-tab" data-bs-toggle="pill" data-bs-target="#upload" type="button" role="tab" aria-controls="upload" aria-selected="true">Upload Foto</button>
                </li>
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="capture-tab" data-bs-toggle="pill" data-bs-target="#capture" type="button" role="tab" aria-controls="capture" aria-selected="false">Ambil Foto Langsung</button>
                </li>
            </ul>
            <div class="tab-content" id="photoOptionsTabContent">
                <!-- Opsi Upload -->
                <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                <div class="mb-3">
                    <label for="courier_proof_upload" class="form-label">Upload Foto Bukti</label>
                    <input type="file" class="form-control" name="courier_proof_upload" id="courier_proof_upload" accept="image/*">
                </div>
                </div>
                <!-- Opsi Ambil Foto Langsung -->
                <div class="tab-pane fade" id="capture" role="tabpanel" aria-labelledby="capture-tab">
                <div class="mb-3">
                    <video id="video" width="100%" autoplay style="border: 1px solid #ccc;"></video>
                    <canvas id="canvas" class="d-none"></canvas>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" id="start-camera">Mulai Kamera</button>
                    <button type="button" class="btn btn-primary ms-2 d-none" id="capture-photo">Ambil Foto</button>
                </div>
                <div class="mt-3" id="photo-preview" style="display: none;">
                    <p>Preview Foto:</p>
                    <img id="captured-image" src="" class="img-fluid"/>
                </div>
                <!-- Input tersembunyi untuk menyimpan data gambar (base64) -->
                <input type="hidden" name="courier_proof_capture" id="courier_proof_capture">
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Foto Bukti</button>
            </div>
        </div>
        </form>
    </div>
    </div>
    @endif

        <script>
      // Event listener untuk edit buttons
      const editButtons = document.querySelectorAll('.edit-btn');
      editButtons.forEach(button => {
        button.addEventListener('click', function() {
          const deliveryId = this.getAttribute('data-id');
          const statusEl = document.querySelector(`#status_${deliveryId}`);
          if (statusEl) {
            const statusValue = statusEl.value.trim();
            statusEl.value = statusValue;
          }
          const frm = document.querySelector(`#frmDeliveries_${deliveryId}`);
          if (frm) {
            frm.action = `{{ url('deliveries') }}/${deliveryId}`;
          }
          $(`#editModal_${deliveryId}`).modal('show');
        });
      });
    
      // Event listener untuk tombol "Ambil Foto Bukti"
      const ambilFotoButtons = document.querySelectorAll('.ambil-foto-btn');
      ambilFotoButtons.forEach(button => {
        button.addEventListener('click', function() {
          const deliveryId = this.getAttribute('data-id');
          const frmAmbilFoto = document.getElementById('frmAmbilFoto');
          if (frmAmbilFoto) {
            frmAmbilFoto.action = `{{ url('deliveries') }}/${deliveryId}`;
          }
          $('#ambilFotoModal').modal('show');
        });
      });
    
      // Tampilkan pesan sukses jika ada
      const statusMsgEl = document.getElementById('status');
      const messageEl = document.getElementById('message');
      const successStatus = statusMsgEl ? statusMsgEl.value : '';
      const successMessage = messageEl ? messageEl.value : '';
      if (successStatus === 'success' && successMessage) {
        swal("Success!", successMessage, "success");
      }
    </script>
@endsection
