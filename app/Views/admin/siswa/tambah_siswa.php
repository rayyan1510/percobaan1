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
<div class="col-xl-9 col-md-6 mb-4">
	<div class="card shadow h-100 py-2">
		<div class="card-body">
			<form action="<?= base_url('admin/siswa/add') ?>" method="POST">
    			<?= csrf_field(); ?>

			<div class="row">
				<div class="col-md-6">
                	<div class="form-group">
				      <label for="nis">NISN</label>
				      <input type="text" class="form-control" name="nisn" id="nisn" value="<?= set_value('nisn','',true) ?>">
				    </div>
				        
			     	<div class="form-group">
				      <label for="nis">NIS</label>
				      <input type="text" class="form-control" name="nis" id="nis" value="<?= set_value('nis','',true) ?>">
				    </div>
				        
			     	<div class="form-group">
				      <label for="nama">Nama</label>
				      <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama','',true) ?>">
				    </div>

				    <div class="form-group">
	                    <label for="level">Tahun SPP</label>
	                    <select class="custom-select" id="spp" name="spp">
	                    <?php foreach($spp as $item) : ?>
	                        <option value="<?= $item['id_spp'] ?>"><?= $item['tahun'] ?></option>
	                    <?php endforeach; ?>
	                    </select>
	                </div>
					<div class="form-group">
	                  	<label for="kelas">Kelas</label>
	                   	<select class="custom-select" id="kelas" name="kelas">
	                    <?php foreach($kelas as $item) : ?>
	                    	<option value="<?= $item['id_kelas'] ?>"><?= $item['nama_kelas'] ?></option>
	                    <?php endforeach; ?>
	                  </select>
	                </div>
				</div>

				<div class="col-md-6"> 
	                <div class="form-group">
				        <label for="alamat">Alamat</label>
				        <input type="text" class="form-control" name="alamat" id="alamat" value="<?= set_value('alamat','',true) ?>">
				    </div>
	                    
	                <div class="form-group">
				        <label for="notelpon">No. Telepon</label>
				        <input type="number" class="form-control" name="telepon" id="nama" value="<?= set_value('no_telp','',true) ?>">
				    </div>

                    <div class="form-group">
				      	<label for="password">Password</label>
				      	<input type="password" class="form-control" name="password" id="password" value="<?= set_value('password','',true) ?>">
				    </div> 

				    <div class="form-group">
	                  	<label for="level">Level</label>
                      	<input class="form-control" type="text" value="Siswa" readonly>
                       	<input type="hidden" class="form-control" name="level" value="3">
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