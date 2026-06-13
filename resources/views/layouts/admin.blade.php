<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('page_title', 'Tokonanas') - Admin Dashboard</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('welcome') }}" class="brand-link" style="background-color: #1f2937;">
            <img src="{{ asset('images/logo.png') }}" alt="Tokonanas Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 36px; height: 36px; margin-left: 10px;">
            <span class="brand-text font-weight-light"><strong>Tokonanas</strong></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link @if(Route::currentRouteName() === 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('user_marketings.index') }}" class="nav-link @if(in_array(Route::currentRouteName(), ['user_marketings.index', 'user_marketings.create', 'user_marketings.edit', 'user_marketings.show'])) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User Marketing
                                <span class="badge badge-info right">{{ \App\Models\UserMarketing::count() }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('produk.index') }}" class="nav-link @if(in_array(Route::currentRouteName(), ['produk.index', 'produk.create', 'produk.edit', 'produk.show'])) active @endif">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Produk
                                <span class="badge badge-warning right">{{ \App\Models\Produk::count() }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('customer.index') }}" class="nav-link @if(in_array(Route::currentRouteName(), ['customer.index', 'customer.create', 'customer.edit', 'customer.show'])) active @endif">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Customer
                                <span class="badge badge-success right">{{ \App\Models\Customer::count() }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('transaksi.index') }}" class="nav-link @if(in_array(Route::currentRouteName(), ['transaksi.index', 'transaksi.create', 'transaksi.edit', 'transaksi.show'])) active @endif">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>
                                Transaksi
                                <span class="badge badge-danger right">{{ \App\Models\Transaksi::count() }}</span>
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('page_title', 'Dashboard')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item active">@yield('page_title', 'Dashboard')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Tokonanas Admin Dashboard</strong> - Manajemen Penjualan Online
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
@stack('scripts')
</body>
</html>
