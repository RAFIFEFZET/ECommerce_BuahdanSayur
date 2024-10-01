@extends('dashboard.master')
@section('title','Sayur Dan Buah')
@section('nav')
    @include('dashboard.nav')
@endsection
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Contact</h1>
    <ol class="breadcrumb justify-content-center mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active text-white">Contact</li>
    </ol>
  </div>
  <!-- Single Page Header End -->

  <!-- Contact Start -->
  <div class="container-fluid contact py-5">
    <div class="container py-5">
      <div class="p-5 bg-light rounded">
        <div class="row g-4">
          <div class="col-12">
            <div class="text-center mx-auto" style="max-width: 700px">
              <h1 class="text-primary">Hubungi Kami</h1>
              <p>
                Selamat datang di GreenMart!
              </p>
              <p class="mb-4" style="text-align: justify">
                Kami senang dapat melayani kebutuhan buah dan sayur segar Anda. Jika Anda memiliki pertanyaan, saran, atau butuh bantuan, jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda!
              </p>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="h-100 rounded">
              <iframe
                class="rounded w-100"
                style="height: 400px"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.0825961664696!2d106.80419617504019!3d-6.51122929348113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c3d1c2d55419%3A0x56aae4179cd95995!2sJl.%20Raya%20Karadenan%20No.7%2C%20Karadenan%2C%20Kec.%20Cibinong%2C%20Kabupaten%20Bogor%2C%20Jawa%20Barat%2016913!5e0!3m2!1sid!2sid!4v1717648585285!5m2!1sid!2sid"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="d-flex flex-wrap justify-content-between p-4 rounded mb-4 bg-white">
              <div class="d-flex align-items-center mb-4 me-4">
                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                <div>
                  <h4>Address</h4>
                  <p class="mb-2">Jl. Raya Karadenan No.7, Karadenan, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16111</p>
                </div>
              </div>
              <div class="d-flex align-items-center mb-4 me-4">
                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                <div>
                  <h4>Mail Us</h4>
                  <p class="mb-2">Greenmart@gmail.com</p>
                </div>
              </div>
              <div class="d-flex align-items-center mb-4 me-4">
                <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                <div>
                  <h4>Telephone</h4>
                  <p class="mb-2">(+62) 8201 2345</p>
                </div>
              </div>
              <div class="d-flex align-items-center mb-4">
                <i class="fa fa-clock fa-2x text-primary me-4"></i>
                <div>
                  <h4>Operational Hours</h4>
                  <p class="mb-2">Mon - Fri: 08:00 - 18:00<br>Sat: 09:00 - 17:00<br>Sun: Closed</p>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <!-- Contact End -->

@section('footer')
  @include('dashboard.footer')
@endsection  