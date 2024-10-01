<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>
    @yield('title')
  </title>

  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet"/>
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
  
  

  {{-- Choices.js --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Load Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <!-- Load Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <style>
    .custom-badge {
    position: relative; /* Tambahkan posisi relatif untuk memungkinkan overflow hidden */
    display: inline-block; /* Tambahkan tampilan inline-block untuk memastikan badge berukuran sesuai kontennya */
    z-index: 999; /* Sesuaikan dengan kebutuhan Anda */
    color: floralwhite;
    background-color: #5e72e4; /* Atur warna latar belakang sesuai kebutuhan Anda */
    border: 1px solid white; /* Atur ketebalan dan warna tepi sesuai kebutuhan Anda */
    border-radius: 50%; /* Membuat badge menjadi bentuk bulatan */
    padding: 4px; /* Sesuaikan dengan kebutuhan Anda */
    width: 24px; /* Tambahkan lebar dan tinggi yang sama untuk membuat badge menjadi bulatan */
    height: 24px;
    text-align: center; /* Pusatkan teks di dalam badge */
    line-height: 1; /* Pastikan teks tetap di tengah vertikal */
}

.badge-circle.custom-badge::after {
    content: ''; /* Tambahkan konten kosong untuk elemen setelahnya */
    display: block; /* Jadikan elemen setelahnya sebuah blok */
    position: absolute; /* Atur posisi absolut untuk memungkinkan pengaturan border-radius */
    top: 0; /* Posisikan di atas */
    left: 0; /* Posisikan di kiri */
    width: 100%; /* Ambil lebar 100% */
    height: 100%; /* Ambil tinggi 100% */
    border-radius: 50%; /* Bentuk bulatan */
    background-color: inherit; /* Gunakan warna latar belakang badge */
    z-index: -1; /* Z-index negatif untuk memastikan badge tetap di belakang konten lain */
    background-image: linear-gradient(to right, #5e72e4, #82dcf7);
}
.tippy-tooltip.lime-theme {
    background-image: linear-gradient(to right, #5e72e4, #82dcf7);
    color: #fff;
}

.tippy-tooltip.lime-theme .tippy-arrow {
    color: transparent;
}

.tippy-tooltip.lime-theme[data-placement^='top'] > .tippy-arrow::before {
    border-top-color: #5e72e4;
    border-top-color: linear-gradient(to right, #5e72e4, #82dcf7);
}
        .text-container {
    background-color: rgba(115, 250, 196, 0.8); /* White background with 80% opacity */
    padding: 20px;
    border-radius: 10px;
    height: 250px;
}
.text-container h1, .text-container p {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Black shadow with some opacity */
}
.section-container {
    margin-top: 50px;
    text-align: justify;
}
.section-container-isi {
    margin-top: 20px;
}
  </style>
</head>
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
  });
</script>
<body class="g-sidenav-show   bg-gray-100" id="master">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  @yield('nav')
  @yield('main')
    <!-- End Navbar -->
    @yield('dashboard')
    @yield('dashboardregular')
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="https://unpkg.com/popper.js@1"></script>
<script src="https://unpkg.com/tippy.js@5"></script>
<script>
  async function fetchData(year) {
    const response = await fetch(`/order-data?year=${year}`);
    const data = await response.json();
    return data;
  }

  function updateChart(chart, data) {
    const labels = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    const orderData = new Array(12).fill(0);
    const purchaseData = new Array(12).fill(0);

    data.orders.forEach(item => {
      orderData[item.month - 1] = item.total;
    });

    data.purchases.forEach(item => {
      purchaseData[item.month - 1] = item.total;
    });

    chart.data.datasets[0].data = orderData;
    chart.data.datasets[1].data = purchaseData;
    chart.update();
  }

  const ctx1 = document.getElementById("chart-line").getContext("2d");
  const gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
  gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
  gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
  gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

  const chart = new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
      datasets: [
        {
          label: "Orders",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: new Array(12).fill(0),
          maxBarThickness: 6
        },
        {
          label: "Purchases",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#ff0000",
          backgroundColor: 'rgba(255, 0, 0, 0.2)',
          borderWidth: 3,
          fill: true,
          data: new Array(12).fill(0),
          maxBarThickness: 6
        }
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#fbfbfb',
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            color: '#ccc',
            padding: 20,
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
      },
    },
  });

  document.getElementById('yearSelect').addEventListener('change', async function() {
    const year = this.value;
    const data = await fetchData(year);
    updateChart(chart, data);
  });

  async function populateYearOptions() {
    const currentYear = new Date().getFullYear();
    const select = document.getElementById('yearSelect');
    for (let year = currentYear; year >= 2000; year--) {
      const option = document.createElement('option');
      option.value = year;
      option.text = year;
      select.appendChild(option);
    }
    // Set the current year as selected and fetch the data for the first time
    select.value = currentYear;
    const data = await fetchData(currentYear);
    updateChart(chart, data);
  }

  populateYearOptions();
</script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script>
    // First, create the singleton instance
    const singleton = tippy.createSingleton(tippy('[data-tippy-content]'), {
        theme: 'lime',
        animation: 'scale',
        moveTransition: 'transform 1s ease-out',
    });
    
    // Then, initialize the tooltips
    tippy('[data-tippy-content]', {
        onCreate(instance) {
            instance.enable();
        },
        onTrigger(instance) {
            singleton.show(instance);
        },
        onUntrigger(instance) {
            singleton.hide();
        }
    });
</script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

</body>

</html>