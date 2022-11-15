<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- datatables -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h5 mb-0 text-primary"><?= $title ?></h1>
  </div>
  <div class="card shadow border-left-primary mb-4">
    <div class="card-header py-3">
      <a href="<?= base_url('admin/user/add') ?>" class="btn btn-primary mb-0">Tambah</a>
    </div>
    <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped" id="datatables">
        <thead>
          <tr>
            <th class="text-center">
              #
            </th>
            <th>Nama</th>
            <th>Email</th>
            <th>Level</th>
            <th>Date Created</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<!-- modal delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus data ini?</p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
        <form action="<?= base_url('admin/user/delete') ?>" method="POST">
          <?= csrf_field(); ?>
          <input type="hidden" id="delete-input-id" name="id" value="">
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    var table = $('#datatables').DataTable({
      "responsive": true, "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": "<?= base_url('ajax/get_users') ?>",
        "type": "POST",
        data: function(data) {
          data._csrf = getCsrf();
        },
        complete: function(data) {
          setCsrf(JSON.parse(data.responseText).csrf);
        }
      },
      //optional
      "lengthMenu": [
        [5, 10, 25, 100],
        [5, 10, 25, 100]
      ],
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