<!doctype html>
<html lang="en">
  <head>
  	<title>Greenmart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css-sidebar/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css-stepbar/style.css') }}">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
	<style>
		.confirm-button {
			border: 2px solid #ffb524 !important;
			color: #81c408 !important;
			transition: background-color 0.3s, color 0.3s;
		}
		.pay-button {
			border: 2px solid #ffb524 !important;
			color: #81c408 !important;
			transition: background-color 0.3s, color 0.3s;
		}
		.btn.border-secondary {
		transition: 0.5s;
		}
	
		.btn.border-secondary:hover {
			background: #ffb524 !important;
			color: #fff !important;
		}
	</style>
	<style>
		.star-color{
			color: #ffb524 !important;
		}
		.me-3 {
		margin-right: 1rem !important;
		}
		.carousel-indicators li {
		background-color: #808080;
		}
		.carousel-indicators .active {
			background-color: #303030;
		}
		.rating .fa-star {
			cursor: pointer;
			color: #ddd;
		}
		.rating .fa-star.selected,
		.rating .fa-star:hover,
		.rating .fa-star:hover ~ .fa-star {
			color: #ffd700;
		}
		/* CSS untuk gambar produk */
		.product-image {
			width: 100%;
			height: auto;
			border-radius: 10px; /* Mengatur sudut border untuk gambar */
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Efek bayangan untuk gambar */
			transition: transform 0.3s ease; /* Efek transisi ketika gambar digulung */
		}

		/* Efek transisi hover */
		.product-image:hover {
			transform: scale(1.05); /* Perbesar gambar saat dihover */
		}
		.confirm-button:disabled {
			background-color: #gray;
			color: #white;
			cursor: not-allowed;
		}
	</style>
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 pt-5">
		  		<h1><a href="{{ route('home') }}" class="logo">Customer Panel</a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li>
	              <a href="{{ route('profile.index') }}">Profile</a>
	          </li>
	          <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Transaksi ku</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="{{ route('unpaidordercustomer.index') }}">Unpaid Order</a>
                </li>
                <li>
                    <a href="{{ route('sidebarpage.orderstatus') }}">Order Status</a>
                </li>
                @if(isset($product))
					<li>
						<a href="{{ route('sidebarpage.reviewproduct', ['id' => $product->id]) }}">Review product</a>
					</li>
				@else
					<li>
						<a href="#">No product available for review</a>
					</li>
				@endif				
              </ul>
	        </ul>

	        {{-- <div class="mb-5">
						<h3 class="h6">Subscribe for newsletter</h3>
						<form action="#" class="colorlib-subscribe-form">
	            <div class="form-group d-flex">
	            	<div class="icon"><span class="icon-paper-plane"></span></div>
	              <input type="text" class="form-control" placeholder="Enter Email Address">
	            </div>
	          </form>
					</div>

	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div> --}}

	      </div>
    	</nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            @yield('content')
        </div>
		</div>

    <script src="{{ asset('js-sidebar/jquery.min.js') }}"></script>
    <script src="{{ asset('js-sidebar/popper.js') }}"></script>
    <script src="{{ asset('js-sidebar/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js-sidebar/main.js') }}"></script>
    <script src="{{ asset('js-stepbar/main.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			@if (session('success'))
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: '{{ session('success') }}',
					showConfirmButton: false,
					timer: 1500
				});
			@endif

			@if (session('error'))
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: '{{ session('error') }}',
					showConfirmButton: false,
					timer: 1500
				});
			@endif

			document.querySelectorAll('.delete-cart-form').forEach(form => {
				form.addEventListener('submit', function (e) {
					e.preventDefault();

					Swal.fire({
						title: 'Are you sure?',
						text: "You won't be able to revert this!",
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
						if (result.isConfirmed) {
							form.submit();
						}
					});
				});
			});
		});
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', (event) => {
			const stars = document.querySelectorAll('.rating .fa-star');
			const ratingInput = document.querySelector('input[name="rating"]');
			let ratingSelected = false;
		
			stars.forEach(star => {
				star.addEventListener('click', () => {
					ratingSelected = true;
					const ratingValue = star.getAttribute('data-value');
					ratingInput.value = ratingValue;
		
					// Reset the color of all stars
					stars.forEach(s => s.classList.remove('selected'));
		
					// Set the color of the selected stars
					star.classList.add('selected');
					let nextStar = star.nextElementSibling;
					while (nextStar) {
						nextStar.classList.add('selected');
						nextStar = nextStar.nextElementSibling;
					}
				});
		
				star.addEventListener('mouseover', () => {
					stars.forEach(s => s.classList.remove('hover'));
					star.classList.add('hover');
					let nextStar = star.nextElementSibling;
					while (nextStar) {
						nextStar.classList.add('hover');
						nextStar = nextStar.nextElementSibling;
					}
				});
		
				star.addEventListener('mouseout', () => {
					stars.forEach(s => s.classList.remove('hover'));
				});
			});
		
			// Add event listener to the form
			const form = document.querySelector('#reviewform');
			form.addEventListener('submit', (e) => {
				if (!ratingSelected) {
					e.preventDefault();
					alert('Please select a rating.');
				}
			});
		});
	</script>	
  </body>
</html>