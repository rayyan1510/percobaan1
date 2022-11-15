 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
   <title><?= $this->renderSection('title') ?></title>
   <?= csrf_meta() ?>
   <!-- Bootstrap -->
   <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="/assets/bootstrap/css/sb-admin-2.min.css" >
   <!-- Font Awesome -->
   <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
   <!-- datatables css -->
   <link rel="stylesheet" href="/assets/DataTables/DataTables/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css">
   <link rel="stylesheet" href="/assets/stisla/assets/css/bootstrap-select.css">
   <!-- select2 -->
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

   <?= $this->renderSection('css') ?>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/') ?>">
            <div class="sidebar-brand-text mx-3">Pembayaran SPP</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider ">

        <!-- Heading -->
        <div class="sidebar-heading">Dashboard</div> 
            
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/') ?>">
              <i class="fas fa-fw fa-home"></i>
              <span>Dashboard</span></a>
        </li>

    <?php if (session()->get('id_level') == 1) : ?>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">User</div>
        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/kelas') ?>">
              <i class="fas fa-fw fa-chalkboard-teacher"></i>
              <span>Kelas</span></a>
        </li>        
        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/siswa') ?>">
              <i class="fas fa-fw fa-users"></i>
              <span>Siswa</span></a>
        </li>
        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/users') ?>">
              <i class="fas fa-fw fa-user"></i>
              <span>Petugas</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">SPP</div>
        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/spp') ?>">
              <i class="fas fa-fw fa-file-invoice-dollar"></i>
              <span>Data SPP</span></a>
        </li>   

    <?php endif; ?>     

    <?php if (session()->get('id_level') != 3) : ?>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/bayar') ?>">
              <i class="fas fa-fw fa-money-bill-wave"></i>
              <span>Pembayaran SPP</span></a>
        </li>
        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/histori') ?>">
              <i class="fas fa-fw fa-money-check-alt"></i>
              <span>History Pembayaran</span></a>
        </li>
        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/laporan') ?>">
              <i class="fas fa-fw fa-print"></i>
              <span>Laporan</span></a>
        </li>

    <?php endif; ?>

    <?php if (session()->get('id_level') == 3) : ?>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">SPP</div>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('siswa/histori') ?>">
              <i class="fas fa-fw fa-money-check-alt"></i>
              <span>History Pembayaran</span></a>
        </li> 

    <?php endif; ?>
   
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>                

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat datang, <?= session()->get('nama') ?> </div>
                            <img class="img-profile rounded-circle"
                                src="/assets/stisla/assets/img/undraw_profile.svg">
                        </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <?php if (session()->get('id_level') != 3) : ?>
                                <a class="dropdown-item" href="<?= base_url('admin/user/change_password') ?>">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <?php endif; ?>
                                <?php if (session()->get('id_level') == 3) : ?>
                                <a class="dropdown-item" href="<?= base_url('siswa/change_password') ?>">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('logout') ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Page Header -->
            <div class="main-content">
                <?= $this->include('partials/msg_validation') ?>
                <?= $this->renderSection('content') ?>
              </section>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Footer -->
        <footer class="sticky-footer main-footer d-flex flex-column">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; <?= date('Y'); ?> All rights reserved</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

    <!-- Bootstrap -->
    <script src="/assets/bootstrap/jquery/jquery.min.js"></script>
    <script src="/assets/bootstrap/popper.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/nicescroll/jquery.nicescroll.js"></script>
    <script src="/assets/stisla/assets/js/stisla.js"></script>
    <script src="/assets/bootstrap/jquery-easing/jquery.easing.min.js"></script>
    <!-- Template JS File -->
    <script src="/assets/stisla/assets/js/scripts.js"></script>
    <script src="/assets/stisla/assets/js/custom.js"></script>
    <script src="/assets/stisla/assets/js/bootstrap-select.js"></script>
    <!-- datatables -->
    <script src="/assets/DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="/assets/DataTables/datatables.min.js"></script>
    <script src="/assets/DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="/assets/bootstrap/js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="/assets/bootstrap/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="/assets/bootstrap/js/demo/chart-area-demo.js"></script>
    <script src="/assets/bootstrap/js/demo/chart-pie-demo.js"></script>
    <?= $this->renderSection('script') ?>
</body>
</html>