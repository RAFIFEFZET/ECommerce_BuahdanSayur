@php
    $userLevel = Auth::guard('admin')->user()->level; // Assuming you're using the 'web' guard
@endphp

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('admin.index') }}">
        <img src="{{ asset('assets/img/admin.jpeg') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Admin Dashboard</span>
    </a>    
  </div>

    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}" href="{{ route('admin.index') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        
        <!-- Sidebar items for Admin -->
        @if($userLevel === 'Admin')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('discounts-admin*') ? 'active' : '' }}" href="{{ route('discounts-admin.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tag text-info text-sm opacity-10"></i> <!-- Ikon untuk Discounts -->
                </div>
                <span class="nav-link-text ms-1">Discounts</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-box-2 text-info text-sm opacity-10"></i> <!-- Ikon untuk Products -->
                </div>
                <span class="nav-link-text ms-1">Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('product_categories*') ? 'active' : '' }}" href="{{ route('product_categories.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-bullet-list-67 text-info text-sm opacity-10"></i> <!-- Ikon untuk Product Categories -->
                </div>
                <span class="nav-link-text ms-1">Product Categories</span>
            </a>
        </li>
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Delivery & Order</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('orders*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-cart text-info text-sm opacity-10"></i> <!-- Ikon untuk Orders -->
                </div>
                <span class="nav-link-text ms-1">Orders</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('unpaidorder*') ? 'active' : '' }}" href="{{ route('unpaidorder.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-credit-card text-info text-sm opacity-10"></i> <!-- Ikon untuk Unpaid Order -->
                </div>
                <span class="nav-link-text ms-1">Unpaid Order</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('deliveries*') ? 'active' : '' }}" href="{{ route('deliveries.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user-o text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Deliveries</span>
                @php
                    $waitingConfirmation = \App\Models\Deliveries::where('status', 'Menunggu Konfirmasi')->count();
                @endphp
                @if($waitingConfirmation > 0)
                    <span class="badge badge-md badge-circle badge-floating badge-danger border-white custom-badge" data-bs-toggle="tooltip" data-tippy-content="Ada Orderan baru yang belum diproses">{{ $waitingConfirmation }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('order_details*') ? 'active' : '' }}" href="{{ route('order_details.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-copy-04 text-info text-sm opacity-10"></i> <!-- Ikon untuk Order Details -->
                </div>
                <span class="nav-link-text ms-1">Order Details</span>
            </a>
        </li>
    @endif


    <!-- Sidebar items for Owner -->
    @if($userLevel === 'Owner')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('employees*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user-o text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Employees</span>
            </a>
        </li>
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Cetak Laporan</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('report*') ? 'active' : '' }}" href="{{ route('report.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-shopping-basket text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Cetak Laporan Order</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('purchase-transactions*') ? 'active' : '' }}" href="{{ route('purchase_transactions.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-shopping-basket text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Cetak Laporan Pengeluaran</span>
            </a>
        </li>
    @endif
    <!-- Sidebar items for Employee -->
    @if($userLevel === 'Employee')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('orders*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user-o text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Orders</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('deliveries*') ? 'active' : '' }}" href="{{ route('deliveries.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user-o text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Deliveries</span>
                @php
                    $waitingConfirmation = \App\Models\Deliveries::where('status', 'Menunggu Konfirmasi')->count();
                @endphp
                @if($waitingConfirmation > 0)
                    <span class="badge badge-md badge-circle badge-floating badge-danger border-white custom-badge" data-bs-toggle="tooltip" data-tippy-content="Ada Orderan baru yang belum diproses">{{ $waitingConfirmation }}</span>
                @endif
            </a>
        </li>
    @endif
    <!-- Sidebar items for Courier -->
    @if($userLevel === 'Courier')
    <li class="nav-item">
        <a class="nav-link {{ request()->is('deliveries*') ? 'active' : '' }}" href="{{ route('deliveries.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user-o text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Deliveries</span>
            @php
                $waitingConfirmation = \App\Models\Deliveries::where('status', 'Menunggu Kurir')->count();
            @endphp
            @if($waitingConfirmation > 0)
                <span class="badge badge-md badge-circle badge-floating badge-danger border-white custom-badge" data-bs-toggle="tooltip" data-tippy-content="Ada paket yang belum di PickUp">{{ $waitingConfirmation }}</span>
            @endif
        </a>
    </li>
    @endif
    <!-- Sidebar items for Manager -->
    @if($userLevel === 'Manager')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('employees*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user-o text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Employees</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('suppliers*') ? 'active' : '' }}" href="{{ route('suppliers.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user-o text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Suppliers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('purchasetransactions*') ? 'active' : '' }}" href="{{ route('purchasetransactions.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-credit-card text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Purchase Transactions</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('product_reviews-admin*') ? 'active' : '' }}" href="{{ route('product_reviews-admin.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-shopping-basket text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Product Reviews</span>
            </a>
        </li>
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Cetak Laporan</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('report*') ? 'active' : '' }}" href="{{ route('report.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-shopping-basket text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Cetak Laporan Order</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('purchase-transactions*') ? 'active' : '' }}" href="{{ route('purchase_transactions.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-shopping-basket text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Cetak Laporan Pengeluaran</span>
            </a>
        </li>
      @endif
        {{-- <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li> --}}
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      {{-- <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="{{ asset('assets/img/illustrations/icon-documentation.svg') }}" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
        </div>
      </div> --}}
    </div>
  </aside>