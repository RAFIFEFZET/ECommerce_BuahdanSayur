@extends('admin.master')
@section('title', 'Suppliers / Create')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Suppliers / Create')
@section('main')
    @include('admin.main')

<!-- Tables -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Suppliers Form</h6>
                    <hr class='w-2'>
                    <h6 class='mb-1'>Add Supplier</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="card border-1 m-3 pt-3">
                            <form action="{{ route('suppliers.store') }}" id="frmSuppliers" method="post">
                                @csrf
                                <div class="mb-3 ms-3 me-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                                </div>
                                <div class="mb-3 ms-3 me-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                </div>
                                <div class="mb-3 ms-3 me-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required>
                                </div>
                                <div class="mb-3 ms-3 me-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" name="address" id="address" placeholder="Address" required></textarea>
                                </div>
                                <div class="ms-3 me-3 text-end">
                                    <a href="{{ route('suppliers.index') }}" class="btn bg-gradient-danger w-15 my-4 mb-2">Cancel</a>
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
    const form = document.getElementById("frmSuppliers");
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
@endsection
