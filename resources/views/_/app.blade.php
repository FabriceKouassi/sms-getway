<!DOCTYPE html>

{{-- class="light-style layout-menu-fixed layout-compact"
dir="ltr"
data-theme="theme-default"
data-assets-path="../assets/"
data-template="vertical-menu-template-free" --}}

<html lang="en"

class="light-style layout-menu-fixed layout-compact"
dir="ltr"
data-theme="theme-default"
data-assets-path="../assets/"
data-template="vertical-menu-template-free"
>
    <head>
        <meta charset="utf-8" />
        <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>SMS GETEWAY</title>

        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('model/assets/img/favicon/favicon.ico')}}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('model/assets/vendor/fonts/boxicons.css')}}" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="{{ asset('model/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('model/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{ asset('model/assets/css/demo.css')}}" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{ asset('model/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
        <link rel="stylesheet" href="{{ asset('model/assets/vendor/libs/apex-charts/apex-charts.css')}}" />
        {{-- ---- --}}

            {{-- <link rel="stylesheet" href="{{ asset('custum/css/demo.css')}}"> --}}
            <link rel="stylesheet" href="{{ asset('custum/css/style.css')}}">
            <link rel="stylesheet" href="{{ asset('custum/css/modif.css')}}">

            <!-- Bootstrap 5 CSS -->
            <!-- Data Table CSS -->
            <link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
            <!-- Font Awesome CSS -->
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
        {{-- ---- --}}
        <!-- Page CSS -->

        <!-- Helpers -->
        <script src="{{ asset('model/assets/vendor/js/helpers.js')}}"></script>
        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{ asset('model/assets/js/config.js')}}"></script>
    </head>

  <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">

                @include('_.nav')

                @yield('content')

            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
    {{-- <div class="buy-now">
      <a
        href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> --}}

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('model/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('model/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('model/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('model/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('model/assets/vendor/js/menu.js')}}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('model/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{ asset('model/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{ asset('model/assets/js/dashboards-analytics.js')}}"></script>

    {{-- ---- --}}

    <script src='https://code.jquery.com/jquery-3.7.0.js'></script>
    <!-- Data Table JS -->
    <script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
    <script src='https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js'></script>

    <script src="{{ asset('custum/js/script.js') }}"></script>

    <script src="{{ asset('insertData/typeSMS.js') }}"></script>

    {{-- ---- --}}

  </body>
</html>
