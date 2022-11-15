<?= $this->extend('layouts/master_auth') ?>

<?= $this->section('title') ?>
<?= esc($title); ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">

<body class="bg-gradient-light">

<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">
    <div class="col-xl-5 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5"> 
            <!-- Nested Row within Card Body -->
                <div class="p-5">
                      <div class="text-center">
                        <h4 class="h4 text-gray-900 mb-4">Log In</h4>
                      </div>
                      <hr>

                      <!-- untuk form validasi error -->
                      <?= $this->include('partials/msg_validation') ?>

                      <form class="user" id="petugas" method="POST" action="<?= base_url('login') ?>">
                        <?= csrf_field() ?>

                          <div class="form-group">
                            <input id="email" type="email" class="form-control" name="email" tabindex="1" value="<?= set_value('email', '', true) ?>" placeholder="Email...">
                            <div class="invalid-feedback">
                              email tidak boleh kosong
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="d-block">
                            </div>
                              <input id="password" type="password" class="form-control" name="password" tabindex="2" placeholder="Password...">
                            <div class="invalid-feedback">
                              password tidak boleh kosong
                            </div>
                          </div>

                          <hr>
                          <div class="form-group text-right">
                            <button type="submit" class="btn btn-info btn-block" tabindex="4">
                              Login
                            </button>
                          
                            <a href="<?= base_url('loginsiswa') ?>" class="btn btn-info btn-block">
                              <i class="fas fa-users fa-fw"></i> Login sebagai siswa
                            </a>
                          </div>
                          </hr>
                      </form>

                      <div class="text-center mt-5 text-small">
                        Pembayaran SPP Web SMK Negeri 9 Medan
                      </div>
                      <div class="text-center mt-2 text-small">
                        Copyright &copy; 2021, All rights reserved
                      </div>
                  </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>
</body>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  window.setInterval(ut, 1000);

  function ut() {
    var d = new Date();
    document.getElementById("time").innerHTML = d.toLocaleTimeString();
    document.getElementById("date").innerHTML = d.toLocaleDateString();
  }

</script>
<?= $this->endSection() ?>