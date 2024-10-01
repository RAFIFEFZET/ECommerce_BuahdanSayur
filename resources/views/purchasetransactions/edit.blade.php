@extends('admin.master')

@section('nav')
    @include('admin.nav')
@endsection

@section('page-title', 'Edit Purchase Transactions')
@section('page', 'Edit Purchase Transactions')

@section('main')
    @include('admin.main')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Purchase Transactions</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('purchasetransactions.update', $transaction->id) }}" id="frmTransactions" method="POST" class="p-3">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="product_id" class="form-label">Product</label>
                                <select name="product_id" id="product_id" class="form-control" required>
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" {{ $transaction->product_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-control" required>
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ $transaction->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $transaction->quantity }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="total_price" class="form-label">Total Price</label>
                                <input type="number" name="total_price" id="total_price" class="form-control" value="{{ $transaction->total_price }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="transactions_date" class="form-label">Transactions Date</label>
                                <input type="date" name="transactions_date" id="transactions_date" class="form-control" value="{{ $transaction->transactions_date }}" required>
                            </div>
                            <div class="ms-3 me-3 text-end">
                                <a href="{{ route('purchasetransactions.index') }}" class="btn bg-gradient-danger w-15 my-4 mb-2">Cancel</a>
                                <button type="submit" class="btn bg-gradient-success w-15 my-4 mb-2" id="save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to handle form submission with Swal confirmation
        document.getElementById('updateForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            // Show Swal confirmation dialog
            swal({
                title: "Are you sure?",
                text: "Once updated, the changes cannot be undone!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willUpdate) => {
                if (willUpdate) {
                    // If user confirms update, submit the form
                    this.submit();
                } else {
                    // If user cancels, do nothing
                    swal("Update canceled!", {
                        icon: "info",
                    });
                }
            });
        });
    </script>
    <script>
        // Inisialisasi Flatpickr untuk start date
        flatpickr("#transactions_date", {
            enableTime: true,
            enableSeconds: true,
            time_24hr: true,
        });
    </script>
@endsection
