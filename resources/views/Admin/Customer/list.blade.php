<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Category List</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logoWebsite.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('vendor/css/apex-charts.css') }}" />

    <!-- Kit code for icons -->
    <script src="https://kit.fontawesome.com/1c6258baf1.js" crossorigin="anonymous"></script>

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('vendor/js/config.js') }}"></script>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('vendor/js/jquery.js') }}"></script>
    <script src="{{ asset('vendor/js/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/js/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('vendor/js/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('vendor/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('vendor/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="" class="app-brand-link"> <!--! Input link here -->
              <span class="app-brand-text menu-text fw-bolder ms-2"><img src="{{ asset('img/android-icon-36x36.png') }}"></span>
              <span class="app-brand-text menu-text fw-bolder ms-2">MF Manager</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="app-brand-1 demo-1">
            @if (Session()->has('LoginID'))
                <div class="welcome"
                    style="magin-top: 12px; background-color: white; color:rgb(35, 179, 90); display:inline-block">
                    <p style="margin-right: 1px"><i class="fas fa-user-tie"></i> | <?php echo session()->get('Name'); ?></p>
                    {{-- username --}}
                </div>
                <a style="margin-left: 10px;" class="nav-icon position-relative text-decoration-none"
                    href="{{ url('adminLogOut') }}">
                    <i class="fas fa-sign-out-alt fa-lg"></i>
                </a>
            @else
                <a class="nav-icon position-relative text-decoration-none" href="{{ url('loginAdmin') }}">
                    <i class="fa fa-fw fa-user text-dark mr-3"></i>
                </a>
            @endif
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
                <a href="{{ url('dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-house"></i>
                    <div data-i18n="Dashboard">Dashboard</div>
                </a>
            </li>

            <!-- Accounts -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Accounts</span>
            </li>
            {{-- Admins --}}
            <li class="menu-item">
                <a href="{{ url('listAdmin') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-user"></i>
                    <div data-i18n="Admins">Admins</div>
                </a>
            </li>
            {{-- Customers --}}
            <li class="menu-item active">
                <a href="{{ url('listCustomer') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-people-group"></i>
                    <div data-i18n="Customers">Customers</div>
                </a>
            </li>

            <!-- Products -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Products</span>
            </li>
            <!-- Categories -->
            <li class="menu-item">
                <a href="{{ url('listCategory') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-arrow-down-short-wide"></i>
                    <div data-i18n="Categories">Categories</div>
                </a>
            </li>
            <!-- Products -->
            <li class="menu-item">
              <a href="{{ url('listProduct') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-shirt"></i>
                <div data-i18n="Products">Products</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->
    <div class="layout-page">
        <div class="container" style="margin-top: 20px;">
            <div class="row">
                <div class="col-md-12">
                    {{-- Notification --}}
                    @if (Session::has('success'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    {{-- Page title --}}
                    <div style="margin-left: 5%; float:left;">
                        <h2>Customer List</h2>
                    </div>

                    @if (Session::has('LoginID'))
                        {{-- If admin is logged in then show table --}}
                        @if ($data->isNotEmpty())
                            {{-- If $data is not empty then fetch data --}}
                            <table class="table table-hover" style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;">
                                <thead>
                                    {{-- Table header --}}
                                    <tr style="text-align: center; vertical-align:middle">
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Fetch table data --}}
                                    @foreach ($data as $row)
                                        <tr style="text-align: center; vertical-align:middle">
                                            <td>{{ $row->Customer_ID }}</td>
                                            <td>{{ $row->Customer_Username }}</td>
                                            <td>{{ $row->Customer_Name }}</td>
                                            <td>{{ $row->Email }}</td>
                                            <td>{{ $row->Phone }}</td>
                                            <td>{{ $row->Address }}</td>
                                            <td>{{ $row->Gender }}</td>
                                            <td>{{ $row->Date_of_Birth }}</td>
                                            <td>
                                                <a href="{{ url('deleteCustomer/' . $row->Customer_Username) }}" class="btn btn-danger"
                                                    onclick="return confirm('Confirm delete?')">
                                                <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            {{-- If $data is empty then show error message --}}
                            <br><br>
                            <hr>
                            <div class="text-danger">Error ! No data found !</div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
