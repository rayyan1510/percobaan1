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
<div class="col-xl-9 col-md-6 mb-4 ">
	<div class="card shadow h-100 py-2">
		<div class="card-body">
			<form action="<?= base_url('admin/siswa/edit/'.$siswa['id_siswa']) ?>" method="POST">
    		<?= csrf_field(); ?>

    		<input type="hidden" name="id" value="<?= $siswa['id_siswa'] ?>">
            <input type="hidden" name="level" value="3">

			<div class="row">
				<div class="col-md-6">
                	<div class="form-group">
				      <label for="nis">NISN</label>
				      <input type="text" class="form-control" name="nisn" id="nisn" value="<?= $siswa['nisn'] ?>">
				    </div>
				        
			     	<div class="form-group">
				      <label for="nis">NIS</label>
				      <input type="text" class="form-control" name="nis" id="nis" value="<?= $siswa['nis'] ?>">
				    </div>
				        
			     	<div class="form-group">
				      <label for="nama">Nama</label>
				      <input type="text" class="form-control" name="nama" id="nama" value="<?= $siswa['nama'] ?>">
				    </div>

				    <div class="form-group">
	                  <label for="tahunspp">Tahun SPP</label>
	                  <select class="custom-select" id="spp" name="spp">
	                    <?php foreach($spp as $item) : ?>
	                    	<option value="<?= $item['id_spp'] ?>" <?= $siswa['id_spp'] == $item['id_spp'] ? 'selected=""' : ''; ?> ><?= $item['tahun'] ?></option>
	                    <?php endforeach; ?>
	                  </select>
	                </div>
				</div>

				<div class="col-md-6">
    			    <div class="form-group">
	                    <label for="kelas">Kelas</label>
	                    <select class="custom-select" id="kelas" name="kelas">
	                    <?php foreach($kelas as $item) : ?>
	                        <option value="<?= $item['id_kelas'] ?>" <?= $siswa['id_kelas'] == $item['id_kelas'] ? 'selected=""' : ''; ?> ><?= $item['nama_kelas'] ?></option>
	                    <?php endforeach; ?>
	                    </select>
	                </div>
	                    
	                <div class="form-group">
				        <label for="alamat">Alamat</label>
				        <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $siswa['alamat'] ?>">
				    </div>
	                    
	                <div class="form-group">
				        <label for="notelpon">No. Telepon</label>
				        <input type="number" class="form-control" name="telepon" id="nama" value="<?= $siswa['no_telp'] ?>">
				    </div>
				</div>
			</div>

				<hr class="sidebar-divider ">

				<button type="submit" class="btn btn-primary">Submit</button>

				<a href="<?= base_url('admin/siswa') ?>">
					<button type="button" class="btn btn-warning">Batal</button>
				</a>				
			</form>
		</div>
	</div>
</div>
</div>    
<?= $this->endSection() ?>