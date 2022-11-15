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
    		<form action="<?= base_url('admin/bayar/add') ?>" method="POST">
    			<?= csrf_field(); ?>
          		<input type="hidden" name="id_user" class="form-control" value="<?= session()->get('id_user') ?>">
				  <div class="row">
					<div class="col-md-6">
						<div class="form-group">
				          <label for="nominal">NISN</label>
                            <select name="nisn" title="-- Masukkan NISN --" class="form-control" data-live-search="true">
	                        <?php foreach($siswa as $item) : ?>
	                        	<option value="<?= $item['nisn'] ?>"><?= $item['nisn'] ?></option>
	                        <?php endforeach; ?>
                            </select>
				        </div>

        				<div class="form-group">
                            <label>Tanggal Bayar</label>
							<input type="text" value=" <?= date('d - m - Y'); ?>" name="tgl" class="form-control" placeholder="tanggal bayar" readonly>
                         </div> 

				        <div class="form-group">
        				  <label >Bulan Bayar</label>
            				  <select class="form-control" name="bulanbayar">
                				  <option value="Januari" selected="selected">Januari</option>
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
        				  <label >Tahun Bayar</label>
            				<select class="form-control" id="tahun" name="tahunbayar">
	                        <?php foreach($spp as $item) : ?>
	                        	<option value="<?= $item['id_spp'] ?>"><?= $item['tahun'] ?></option>
	                        <?php endforeach; ?>
            				</select>
				   	 	</div>
					</div>

					<div class="col-md-6"> 
				        <div class="form-group">
                            <label >Jumlah Bayar</label>
                            <input type="number" name="jumlah" class="form-control"  placeholder="" required>
                               <small>Tidak boleh melebihi total yang harus bayar</small>
                        </div>
						<div class="form-group">
        				  <label >Total harus dibayar</label>
            				  <select disabled="on" class="form-control" id="nominal">
	                        <?php foreach($spp as $item) : ?>
	                        	<option value="<?= $item['id_spp'] ?>"><?= $item['nominal'] ?></option>
	                        <?php endforeach; ?>
            				  </select>
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

<?= $this->section('script') ?>
 <script>
    $("#tahun").change(function() {
        var t = $("#tahun option:selected").val();
        $("#nominal").val(t)
    })
 </script>
<?= $this->endSection() ?>