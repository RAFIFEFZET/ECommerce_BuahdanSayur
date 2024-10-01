@extends('admin.master')
@section('title', 'Product Categories / Create')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Product Categories / Create')
@section('main')
    @include('admin.main')

<!-- Tables -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Product Categories Form</h6>
                    <hr class='w-2'>
                    <h6 class='mb-1'>Add Product Categories</h6>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="card border-1 m-3 pt-3">
                            <form action="{{ route('product_categories.store') }}" id="frmProductCategories"
                                method="post">
                                @csrf
                                <div class="mb-3 ms-3 me-3">
                                    <label for="category_name" class="form-label">Product Categories Name</label>
                                    <input type="text" class="form-control" name="category_name" id="category_name"
                                        placeholder="Product Categories Name">
                                </div>
                                <div class="ms-3 me-3 text-end">
                                    <a href="{{ route('product_categories.index') }}"
                                        class="btn bg-gradient-danger w-15 my-4 mb-2">Cancel</a>
                                    <button type="submit" class="btn bg-gradient-success w-15 my-4 mb-2"
                                        id="save">Save</button>
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
    const form = document.getElementById("frmProductCategories");
    const btnSave = document.getElementById("save");

    btnSave.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent form submission
        
        let emptyFields = [];

        if (form.category_name.value === "") {
            emptyFields.push("Product Categories");
        }

        if (emptyFields.length > 0) {
            const errorMessage = "Incomplete Data. Please fill in the following fields: " + emptyFields.join(", ");
            swal("Error", errorMessage, "error");
        } else {
            // Ajax request to submit form data
            const formData = new FormData(form);
            fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    
                        .then(() => {
                            // Redirect to index page after successful submission
                            window.location.href = "{{ route('product_categories.index') }}";
                            swal("Success", data.message, "success")
                        });
                } else {
                    // Display error message
                    swal("Error", data.message, "error");
                }
            })
            // .catch(error => {
            //     // Handle fetch error
            //     swal("Error", "An error occurred while processing your request. Please try again later.", "error");
            //     console.error('Error:', error);
            // });
        }
    });
</script>

@endsection
