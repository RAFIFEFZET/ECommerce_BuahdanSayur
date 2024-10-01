@extends('admin.master')

@section('nav')
    @include('admin.nav')
@endsection

@section('page-title', 'Edit Suppliers')
@section('page', 'Edit Suppliers')

@section('main')
    @include('admin.main')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Suppliers</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form id="updateForm" method="POST" action="{{ route('suppliers.update', $suppliers->id) }}" class="p-3">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $suppliers->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $suppliers->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $suppliers->phone) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control" required>{{ old('address', $suppliers->address) }}</textarea>
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
@endsection
