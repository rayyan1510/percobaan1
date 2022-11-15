<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $this->renderSection('title') ?></title>

  <?= csrf_meta() ?>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css"> 
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css"> 
  <!-- datatables css -->
  <link rel="stylesheet" href="/assets/DataTables/DataTables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/css/adminlte.min.css">
  <?= $this->renderSection('css') ?>
</head>

<body>
  <div class="wrapper">
    <!-- Main content -->
    <?= $this->renderSection('content') ?>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
  <!-- Page specific script -->
  <script>
    
    //window.addEventListener("load", window.print());
  </script>
     <!-- Bootstrap -->
     <script src="/assets/bootstrap/jquery/jquery.min.js"></script>
   <script src="/assets/bootstrap/popper.js"></script>
   <script src="/assets/bootstrap/js/bootstrap.min.js"></script>

   <script src="/assets/nicescroll/jquery.nicescroll.js"></script>
   <script src="/assets/stisla/assets/js/stisla.js"></script>

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

   <?= $this->renderSection('script') ?>
</body>

</html>