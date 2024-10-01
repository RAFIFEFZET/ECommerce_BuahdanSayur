@extends('admin.master')
@section('title', 'Discounts / Create')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Discounts / Create')
@section('main')
    @include('admin.main')
    <style>
        .choices[data-type*="select-one"] .choices__list .choices__item--selectable.is-highlighted {
            background-color: #596cff; /* Change to your desired color */
            color: #fff; /* Change to your desired text color */
        }
    </style>
<!-- Tables -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Discounts Form</h6>
                    <hr class='w-2'>
                    <h6 class='mb-1'>Add Discounts</h6>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="card border-1 m-3 pt-3">
                            <form action="{{ route('discounts-admin.store') }}" id="frmDiscounts" method="post">
                                @csrf
                                <div class="mb-3 ms-3 me-3">
                                    <label for="product_id" class="form-label">Product</label>
                                    <div class="border-contrast p-1 rounded">
                                         <select class="form-select border-0 custom-select" id="product_id" name="product_id" aria-label="product_id">
                                        <option value="">Select Product</option>
                                        @foreach($products as $productdata)
                                            <option value="{{ $productdata->id }}">{{ $productdata->product_name }}</option>
                                        @endforeach
                                        </select>
                                        @error('product_name')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="mb-3 ms-3 me-3">
                                    <label for="start_date" class="form-label">start date</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date"
                                        placeholder="New start date">
                                    @error('start_date')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror    
                                </div>
                                <div class="mb-3 ms-3 me-3">
                                    <label for="end_date" class="form-label">New end date</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date"
                                        placeholder="New end date">
                                    @error('end_date')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror     
                                </div>
                                <div class="mb-3 ms-3 me-3">
                                    <label for="percentage" class="form-label">Discount percentage</label>
                                    <input type="number" class="form-control" name="percentage" id="percentage"
                                        placeholder="New percentage">
                                    @error('percentage')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror     
                                </div>
                                <div class="ms-3 me-3 text-end">
                                    <a href="{{ route('discounts-admin.index') }}"
                                        class="btn bg-gradient-danger w-15 my-4 mb-2">Cancel</a>
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
    <footer class="footer pt-5 ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold"
                            target="_blank">Supriadi's Team</a>
                        for a better web.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script>
    const btnSave = document.getElementById("save");
    const form = document.getElementById("frmDiscounts");

    function simpan() {
        let product_name = document.getElementById("product_name").value;
        let start_date = document.getElementById("start_date").value;
        let end_date = document.getElementById("end_date").value;
        let percentage = document.getElementById("percentage").value;
        // Menggunakan array untuk menyimpan pesan kesalahan
        let errorMessages = [];

        // Memeriksa input dan menambahkan pesan kesalahan ke array jika diperlukan
        if (product_name.trim() === "") {
            errorMessages.push("Product name is required");
        }
        if (start_date.trim() === "") {
            errorMessages.push("start_date is required");
        }
        if (end_date.trim() === "") {
            errorMessages.push("end_date is required");
        }
        if (percentage.trim() === "") {
            errorMessages.push("percentage is required");
        }
        // Cek jika terdapat pesan kesalahan
        if (errorMessages.length > 0) {
        // Tampilkan pesan kesalahan jika ada
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: errorMessages.join("\n"), // Menggabungkan pesan kesalahan menjadi satu string yang dipisahkan dengan baris baru
            });
        } else {
        // Lanjutkan dengan mengirim formulir jika tidak ada kesalahan
            form.submit();
        }       
    }
    btnSave.onclick = function () {
        simpan();
    };

</script>
<script>
    // Inisialisasi Flatpickr untuk start date
    flatpickr("#start_date", {
        enableTime: true,
        enableSeconds: true,
        time_24hr: true,
        dateFormat: "Y-m-d H:i:",
    });

    // Inisialisasi Flatpickr untuk end date
    flatpickr("#end_date", {
        enableTime: true,
        enableSeconds: true,
        time_24hr: true,
        dateFormat: "Y-m-d H:i:",
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi Choices.js untuk input product_name
        var selectProduct = new Choices('#product_id', {
            searchEnabled: true,
            placeholder: true,
            placeholderValue: 'Choose a product',
        });
    });
</script>


@endsection
