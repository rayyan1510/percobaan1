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
				<form action="<?= base_url('admin/spp/edit/'.$spp['id_spp']) ?>" method="POST">
    				<?= csrf_field(); ?>

    				<input type="hidden" name="id" value="<?= $spp['id_spp'] ?>">

					<div class="form-group">
						<label for="tahun">Tahun SPP</label>
						<input type="text" class="form-control" name="tahun" id="tahun" value="<?= $spp['tahun'] ?>">
					</div>
				        
					<div class="form-group">
						<label for="nominal">Nominal</label>
						<input type="text" class="form-control" name="nominal" id="nominal" value="<?= $spp['nominal'] ?>">
					</div>

					<hr class="sidebar-divider ">

					<button type="submit" class="btn btn-primary">Submit</button>

					<a href="<?= base_url('admin/spp') ?>">
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