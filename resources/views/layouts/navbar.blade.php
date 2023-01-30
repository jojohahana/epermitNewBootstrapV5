<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('vendor/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('vendor/images/favicon.png') }}" type="image/x-icon">
    <title>EPermit - @yield('title')</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="../../css2.css?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="../../css2-1.css?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="../../css2-2.css?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/fontawesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/daterange-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/select2.css') }}">

    <!-- Plugins css Ends-->
    {{-- SweetAlert2 css  --}}
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('vendor/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/responsive.css') }}">
    {{-- Include Ajax  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body class="landing-wrraper">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper landing-page">
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- header start-->
        <header class="landing-header">
          <div class="custom-container">
            <div class="row">
              <div class="col-12">
                <nav class="navbar navbar-light p-0" id="navbar-example2"><a class="navbar-brand" href="javascript:void(0)"> <img class="img-fluid" src="{{ asset('vendor/images/logo/LogoEpermit.png') }}" alt=""></a>
                  <ul class="landing-menu nav nav-pills">
                    <li class="nav-item menu-back">back<i class="fa fa-angle-right"></i></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('/epermit') }}">E-Permit</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('epermit/formcuti') }}">Form Cuti</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('epermit/formsakit') }}">Form Sakit</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('epermit/checkpermit') }}">Check Izin & Cuti</a></li>
                  </ul>
                  <!-- Button Purchase Non Aktifikan karna ga perlu  -->
                  <!-- <div class="buy-block"><a class="btn-landing" href="../../index.htm?_ga=2.23600954.1414692404.1631602989-185459218.1631602988" target="_blank">Purchase</a>
                    <div class="toggle-menu"><i class="fa fa-bars"></i></div>
                  </div> -->
                </nav>
              </div>
            </div>
          </div>
        </header>
        <!-- header end-->
        <!--home section start-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-12 pt-3">
                  <!-- <h3>Sample Page</h3> -->
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h4 class="mx-auto text-center fw-bold pb-5">@yield('title-content')</h4>
                  </div>
                  <div class="card-body">
                    @yield('content')
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
          {{-- Start Footer  --}}
          <div class="sub-footer">
            <div class="custom-container">
              <div class="row">
                <div class="col-md-6 col-sm-2">
                  <div class="footer-contain"><img class="img-fluid" src="../asset/images/logo/logo.png" alt=""></div>
                </div>
                <div class="col-md-6 col-sm-10">
                  <div class="footer-contain">
                    <p class="mb-0">Developed with Love - Final Project 2023</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('vendor/js/jquery-3.5.1.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('vendor/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('vendor/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- Sidebar jquery-->

    <script src="{{ asset('vendor/js/config.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('vendor/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap/bootstrap.min.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('vendor/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('vendor/js/owlcarousel/owl-custom.js') }}"></script>
    <script src="{{ asset('vendor/js/landing_sticky.js') }}"></script>
    <script src="{{ asset('vendor/js/landing.js') }}"></script>
    <script src="{{ asset('vendor/js/jarallax_libs/libs.min.js') }}"></script>
    <script src="{{ asset('vendor/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('vendor/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('vendor/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ asset('vendor/js/tooltip-init.js') }}"></script>
    <script src="{{ asset('vendor/js/datepicker/daterange-picker/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/js/datepicker/daterange-picker/daterangepicker.js') }}"></script>
    <script src="{{ asset('vendor/js/datepicker/daterange-picker/daterange-picker.custom.js') }}"></script>
    <script src="{{ asset('vendor/js/datepicker/date-time-picker/datetimepicker.custom.js') }}"></script>
    <script src="{{ asset('vendor/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('vendor/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('vendor/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('vendor/js/tooltip-init.js') }}"></script>
    <!-- Plugins JS Ends-->
    {{-- SweetAlert2 JS  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Theme js-->
    <script src="{{ asset('vendor/js/script.js') }}"></script>
    @yield('script')
  </body>
</html>
