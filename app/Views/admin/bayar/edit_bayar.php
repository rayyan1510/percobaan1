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
    		<form action="<?= base_url('admin/bayar/edit/'.$bayar['id_pembayaran']) ?>" method="POST">
    			<?= csrf_field(); ?>

    			<input type="hidden" name="id" value="<?= $bayar['id_pembayaran'] ?>">
    			<input type="hidden" name="iduser" value="<?= session()->get('id_user') ?>">
    					
				  <div class="row">
					<div class="col-md-6">
					<div class="form-group">
				          <label>Petugas</label>
				           <select class="custom-select" disabled="on">
	                        <?php foreach($user as $item) : ?>
	                        	<option value="<?= $item['id_user'] ?>" <?= $bayar['id_user'] == $item['id_user'] ? 'selected=""' : ''; ?> ><?= $item['nama'] ?></option>
	                        <?php endforeach; ?>
	                      </select>
	                      <small>Petugas akan otomatis berubah bila diedit oleh petugas lain.</small>
				        </div>

				       <div class="form-group">
				          <label for="nominal">NISN</label><br>
                            <select name="nisn" title="-- Masukkan NISN --" class="form-control" data-live-search="true">
	                       <?php foreach($siswa as $item) : ?>
	                        	<option value="<?= $item['nisn'] ?>" <?= $bayar['nisn'] == $item['nisn'] ? 'selected=""' : ''; ?> ><?= $item['nisn'] ?></option>
	                        <?php endforeach; ?>
                            </select>
				        </div>
				        
				     	<div class="form-group">
				          <label>Tanggal Bayar</label>
				          <input type="date" class="form-control" name="tgl" value="<?= $bayar['tgl_bayar'] ?>">
				        </div>
					</div>

					<div class="col-md-6"> 
					<div class="form-group">
	                      <label for="tahunbayar">Bulan Dibayar</label><br>
	                      <select title="<?= $bayar['bulan_dibayar'] ?>" class="form-control" name="bulanbayar">
                				  <option value="Januari">Januari</option>
                				  <option value="Februari" >Februari</option>
                				  <option value="Maret" >Maret</option>
                				  <option value="April" >April</option>
                				  <option value="Mei" >Mei</option>
                				  <option value="Juni" >Juni</option>
                				  <option value="Juli" >Juli</option>
                				  <option value="Agustus" >Agustus</option>
                				  <option value="September" >September</option>
                				  <option value="Oktober" >Oktober</option>
                				  <option value="November" >November</option>
                				  <option value="Desember" >Desember</option>
	                      </select>
	                    </div>
	                    
	                    <div class="form-group">
	                      <label for="tahunspp">Tahun Dibayar</label>
	                      <select class="custom-select" name="tahunbayar">
	                        <?php foreach($spp as $item) : ?>
	                        	<option value="<?= $item['id_spp'] ?>" <?= $bayar['id_spp'] == $item['id_spp'] ? 'selected=""' : ''; ?> ><?= $item['tahun'] ?></option>
	                        <?php endforeach; ?>
	                      </select>
	                    </div>
	                    
	                    <div class="form-group">
				          <label>Jumlah bayar</label>
				          <input type="text" class="form-control" name="jumlah" value="<?= $bayar['jumlah_bayar'] ?>">
				        </div>
					</div>
				</div>
				<hr class="sidebar-divider ">

				<button type="submit" class="btn btn-primary">Submit</button>

				<a href="<?= base_url('admin/bayar') ?>">
					<button type="button" class="btn btn-warning">Batal</button>
				</a>				
			</form>
		</div>
	</div>
</div>
</div>     
<?= $this->endSection() ?>