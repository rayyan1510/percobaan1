<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<style>
   .btn-secondary, .btn-secondary.disabled {
   background-color:#4e73df;
   border:none;
   box-shadow:none;
} 
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- datatables -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-primary"><?= $title ?></h1>
  </div>

  <div class="card shadow border-left-primary mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped" id="datatables">
        <thead>
          <tr>
            <th class="text-center">
              #
            </th>
            <th>Nama Petugas</th>
            <th>NISN</th>
            <th>Tanggal Bayar</th>
            <th>Bulan Dibayar</th>
            <th>Tahun Bayar</th>
            <th>Jumlah Bayar</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    var table = $('#datatables').DataTable({
      "lengthChange": false,
      buttons: [ 'copy', 'csv','excel', 'pdf', 'colvis', 'print' ],
      dom: 'Blfrtip',
      "responsive": true, "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": "<?= base_url('ajax/get_histori') ?>",
        "type": "POST",
        data: function(data) {
          data._csrf = getCsrf();
        },
        complete: function(data) {
          setCsrf(JSON.parse(data.responseText).csrf);
        }
      },

      //optional
      
      "columnDefs": [{
        "targets": [],
        "orderable": false,
      }, ],

    });

    $('#datatables tbody').on('click', '.btn-delete', function(e) {
      const id = e.target.dataset.id;
      $('#deleteModal #delete-input-id').val(id);
      $('#deleteModal').modal();
    });
  });
</script>
<?= $this->endSection() ?>