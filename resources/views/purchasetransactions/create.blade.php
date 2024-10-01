@extends('admin.master')
@section('title', 'Purchase Transactions / Create')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Purchase Transactions / Create')
@section('main')
    @include('admin.main')

<!-- Tables -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Purchase Transactions Form</h6>
                    <hr class='w-2'>
                    <h6 class='mb-1'>Add Purchase Transactions</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="card border-1 m-3 pt-3">
                            <form action="{{ route('purchasetransactions.store') }}" id="frmTransactions" method="POST" class="p-3">
                                @csrf
    
                                <div class="mb-3">
                                    <label for="product_id" class="form-label">Product</label>
                                    <select name="product_id" id="product_id" class="form-control" required>
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="mb-3">
                                    <label for="supplier_id" class="form-label">Supplier</label>
                                    <select name="supplier_id" id="supplier_id" class="form-control" required>
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                                </div>
    
                                <div class="mb-3">
                                    <label for="total_price" class="form-label">Total Price</label>
                                    <input type="number" name="total_price" id="total_price" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="transactions_date" class="form-label">Transactions Date</label>
                                    <input type="date" name="transactions_date" id="transactions_date" class="form-control" required>
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
    </div>

    <!-- Close Tables -->
    <footer class="footer pt-5">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Supriadi's Team</a>
                        for a better web.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script>
    const form = document.getElementById("frmTransactions");
    const btnSave = document.getElementById("save");

    btnSave.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent form submission

        // Check for empty required fields
        let emptyFields = [];
        const requiredFields = form.querySelectorAll("[required]");
        
        requiredFields.forEach(function(field) {
            if (field.value.trim() === "") {
                emptyFields.push(field.name);
            }
        });

        if (emptyFields.length > 0) {
            const errorMessage = "Incomplete Data. Please fill in the following fields: " + emptyFields.join(", ");
            swal("Error", errorMessage, "error");
        } else {
            form.submit();
        }
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
