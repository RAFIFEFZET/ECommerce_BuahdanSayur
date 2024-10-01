@php
    $userLevel = Auth::guard('admin')->user()->level; // Assuming you're using the 'web' guard
@endphp

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html" target="_blank">
        <img src="{{ asset('assets/img/admin.jpeg') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Admin Dashboard</span>
    </a>
  </div>

    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Products</span>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('product_categories*') ? 'active' : '' }}" href="{{ route('product_categories.index') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Product Categories</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('product_reviews*') ? 'active' : '' }}" href="{{ route('product_reviews.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Product Reviews</span>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('orders*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Orders</span>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('order_details*') ? 'active' : '' }}" href="{{ route('order_details.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Order Details</span>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('payments*') ? 'active' : '' }}" href="{{ route('payments.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Payments</span>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('wishlists*') ? 'active' : '' }}" href="{{ route('wishlists.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Wishlists</span>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('customers*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Customers</span>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('deliveries*') ? 'active' : '' }}" href="{{ route('deliveries.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Deliveries</span>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('discounts*') ? 'active' : '' }}" href="{{ route('discounts.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Discounts</span>
        </a>
        </li>
        {{-- <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li> --}}
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="{{ asset('assets/img/illustrations/icon-documentation.svg') }}" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
        </div>
      </div>
    </div>
  </aside>