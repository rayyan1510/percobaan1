 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
   <title><?= $this->renderSection('title') ?></title>

   <!-- Bootstrap -->
   <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="/assets/bootstrap/css/sb-admin-2.min.css" >
   <!-- Font Awesome -->
   <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
   <!-- Template CSS -->
   <link rel="stylesheet" href="/assets/stisla/assets/css/style.css">
   <link rel="stylesheet" href="/assets/stisla/assets/css/components.css">
 </head>

 <body>
   <style>
     .min-vh-100 {
       min-height: 101vh !important;
     }
   </style>

   <div id="app">
     <?= $this->renderSection('content') ?>
   </div>

    <!-- Bootstrap -->
    <script src="/assets/bootstrap/jquery/jquery.min.js"></script>
    <script src="/assets/bootstrap/popper.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/stisla/assets/js/stisla.js"></script>
    <script src="/assets/bootstrap/jquery-easing/jquery.easing.min.js"></script>
    <!-- Template JS File -->
    <script src="/assets/stisla/assets/js/scripts.js"></script>
    <script src="/assets/stisla/assets/js/custom.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="/assets/bootstrap/js/sb-admin-2.min.js"></script>
   <?= $this->renderSection('script') ?>
 </body>
 </html>