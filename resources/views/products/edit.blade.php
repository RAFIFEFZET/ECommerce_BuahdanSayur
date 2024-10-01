@extends('admin.master')
@section('title', 'Product / Edit')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Product / Edit')
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
            <h6>Product Form</h6>
            <hr class='w-2'>
              <h6 class='mb-1'>Edit Product</h6>
              
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <div class="card border-1 m-3 pt-3">
                        <form action="{{ route('products.update', $products->id) }}" method="post" id="ProductForm" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="mb-3 ms-3 me-3">
                            <label for="product_category_id" class="form-label">Product Category</label>
                          <div class="border-contrast p-1 rounded">
                            <select class="form-select border-1 js-example-basic-single" id="product_category_id" name="product_category_id">
                                <option value="">Select Category</option>
                                @foreach($productcategories as $category)
                                    <option value="{{ $category->id }}" {{ $products->product_category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>                                             
                            </div>
                            @error('product_category_id')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>

                          <div class="mb-3 ms-3 me-3">
                              <label for="product_name" class="form-label">Product Name</label>
                              <div class="border-contrast p-1 rounded"> 
                                  <input type="text" class="form-control border-1" id="product_name" name="product_name" placeholder="Name" aria-label="product_name" value="{{ $products->product_name }}">
                              </div>
                              @error('product_name')
                                  <div class="error-message">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="mb-3 ms-3 me-3">
                            <label for="description" class="form-label">Description</label>
                            <div class="border-contrast p-1 rounded"> 
                                <textarea class="form-control border-1" id="description" name="description" placeholder="Description" aria-label="description">{{ $products->description }}</textarea>
                            </div>
                            @error('description')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="mb-3 ms-3 me-3">
                            <label for="price" class="form-label">Price</label>
                            <div class="border-contrast p-1 rounded"> 
                                <input type="number" class="form-control border-1" id="price" name="price" placeholder="Price" aria-label="price" value="{{ $products->price }}">
                            </div>
                            @error('price')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 ms-3 me-3">
                            <label for="stok_quantity" class="form-label">Stock Quantity</label>
                            <div class="border-contrast p-1 rounded"> 
                                <input type="number" class="form-control border-1" id="stok_quantity" name="stok_quantity" placeholder="Stock Quantity" aria-label="stok_quantity" value="{{ $products->stok_quantity }}" disabled>
                            </div>
                            @error('stok_quantity')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 ms-3 me-3">
                            <label for="image1_url" class="form-label">Image 1</label>
                            <div class="border-contrast p-1 rounded"> 
                                <input type="file" class="form-control border-1" id="image1_url" name="image1_url" accept="image/*" aria-label="image1_url" value="{{ $products->image1_url }}">
                            </div>
                            @error('image1_url')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
        
        
                        <div class="mb-3 ms-3 me-3">
                            <label for="image2_url" class="form-label">Image 2</label>
                            <div class="border-contrast p-1 rounded"> 
                                <input type="file" class="form-control border-1" id="image2_url" name="image2_url" accept="image/*" aria-label="image2_url" value="{{ $products->image2_url }}">
                            </div>
                            @error('image2_url')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 ms-3 me-3">
                            <label for="image3_url" class="form-label">Image 3</label>
                            <div class="border-contrast p-1 rounded"> 
                                <input type="file" class="form-control border-1" id="image3_url" name="image3_url" accept="image/*" aria-label="image3_url" value="{{ $products->image3_url }}">
                            </div>
                            @error('image3_url')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 ms-3 me-3">
                            <label for="image4_url" class="form-label">Image 4</label>
                            <div class="border-contrast p-1 rounded"> 
                                <input type="file" class="form-control border-1" id="image4_url" name="image4_url" accept="image/*" aria-label="image4_url" value="{{ $products->image4_url }}">
                            </div>
                            @error('image4_url')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 ms-3 me-3">
                            <label for="image5_url" class="form-label">Image 5</label>
                            <div class="border-contrast p-1 rounded"> 
                                <input type="file" class="form-control border-1" id="image5_url" name="image5_url" accept="image/*" aria-label="image5_url" value="{{ $products->image5_url }}">
                            </div>
                            @error('image5_url')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                          <!-- Add other form fields similar to create.blade.php -->

                          <div class="ms-3 me-3 text-end">
                              <a href="{{ route('products.index') }}" class="btn bg-gradient-danger w-15 my-4 mb-2">Cancel</a>
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
        const form = document.getElementById("ProductForm");
    
        function submitForm() {
            form.submit();
        }
    
        function showAlert(icon, title, text) {
            Swal.fire({
                icon: icon,
                title: title,
                text: text
            });
        }
    
        btnSave.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default form submission behavior
    
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update the product. This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm(); // Submit the form when user confirms
                } else {
                    showAlert('info', 'Update canceled', 'The product update has been canceled.');
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var select = new Choices('#product_category_id', {
                placeholder: true,
                placeholderValue: 'Select Category',
                searchPlaceholderValue: 'Search categories',
                removeItemButton: true,
            });
        });
    </script>
    
    
@endsection
