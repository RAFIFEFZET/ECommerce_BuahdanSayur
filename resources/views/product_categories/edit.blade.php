@extends('admin.master')
@section('title', 'Product Categories / Edit')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Product Categories / Edit')
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
              <h6 class='mb-1'>Edit Product Categories</h6>
              
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <div class="card border-1 m-3 pt-3">
                        <form action="{{ route('product_categories.update', $category->id) }}" method="post" id="frmProductCategories">
                          @csrf
                          @method('PUT')
                            <div class="mb-3 ms-3 me-3">
                                <label for="category_name" class="form-label">Product Categories Name</label>
                                <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Product Categories Name" value="{{ $category->category_name }}">                            </div>
                            <div class="ms-3 me-3 text-end">
                                <a href="{{ route('product_categories.index') }}" class="btn bg-gradient-danger w-15 my-4 mb-2">Cancel</a>
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
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Supriadi's Team</a>
                for a better web.
              </div> 
            </div>
          </div>
        </div>
      </footer>
    </div>
    <script>
      const btnSave = document.getElementById("save");
      const form = document.getElementById("frmProductCategories");
      const cat_name = document.getElementById("category_name");
  
      function simpan() {
          let emptyFields = [];
  
          if (cat_name.value === "") {
              emptyFields.push("Product Categories");
          }
  
          if (emptyFields.length > 0) {
              const errorMessage = "Incomplete Data. Please fill in the following fields: " + emptyFields.join(", ");
              swal("Error", errorMessage, "error");
          } else {
              form.submit();
          }
      }

      form.addEventListener("submit", function(event) {
          event.preventDefault(); // Prevent default form submission
          simpan();
      });
  </script>
@endsection
