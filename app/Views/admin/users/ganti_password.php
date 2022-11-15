<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
    <?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
  	<h1 class="h5 mb-0 text-primary"><?= $title ?></h1>
  </div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-5 col-md-6 mb-4 ">
	<div class="card shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-10">
    				<form action="<?= base_url('admin/user/change_password') ?>" method="POST">
    					<?= csrf_field(); ?>

				  		<div class="form-group">
				          <label for="old_password">Password Lama</label>
				          <input type="password" class="form-control" name="old_password" id="old_password">
				        </div>

				        <div class="form-group">
				          <label for="new_password">Password Baru</label>
				          <input type="password" class="form-control" name="new_password" id="new_password">
				        </div>

				        <div class="form-group">
				          <label for="confirm_password">konfirmasi Password Baru</label>
				          <input type="password" class="form-control" name="confirm_password" id="confirm_password">
				        </div>

					<hr class="sidebar-divider ">

					<button type="submit" class="btn btn-primary">Submit</button>
					<a href="<?= base_url('/') ?>">
					<button type="button" class="btn btn-warning">Batal</button>
					</a>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div> 
<?= $this->endSection() ?>