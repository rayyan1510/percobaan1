<?= $this->extend('layouts/master_print') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-12">
      <h2 class="page-header">
        <i class="fas fa-globe"></i> Struk Pembayaran SPP
        <img width="15%" class="float-right" src="/assets/img/smkn9 2.png" alt="SMKN9">
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <br>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      Dari Petugas,
      <address>
        <strong><?= session()->get('nama') ?></strong><br>
        Email: <?= session()->get('email') ?>
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      Untuk
      <address>
        NISN : <?= $bayar['nisn'] ?><br>
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <b>Dicetak Pada Tanggal : <?= date('d - m - Y'); ?></b><br>
      <br>
      <b>ID Pembayaran:</b> SPP-00<?= $bayar['id_pembayaran'] ?><br>
      <b>Pembayaran Tanggal:</b> <?= $bayar['tgl_bayar'] ?><br>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <br>
  <!-- Table row -->
  <div class="row">
    <div class="col-12 table-responsive">
      <table class="table table-striped" id="datatables">
        <thead>
          <tr>
            <th class="text-center">
              #
            </th>
            <th>NISN</th>
            <th>Waktu Pembayaran</th>
            <th>Bulan Dibayar</th>
            <th>Jumlah Bayar</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">
              1
            </td>
            <td><?= $bayar['nisn'] ?></td>
            <td><?= $bayar['created_at'] ?></td>
            <td><?= $bayar['bulan_dibayar'] ?></td>
            <td>
              <?= "Rp " . number_format($bayar['jumlah_bayar'], 2, ',', '.') ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <br><br>
  <div class="row">
    <!-- accepted payments column -->
    <div class="col-6">
      <p class="lead">Metode Pembayaran:</p>
      <img src="/assets/img/credit/visa.png" alt="Visa">
      <img src="/assets/img/credit/mastercard.png" alt="Mastercard">
      <img src="/assets/img/credit/paypal2.png" alt="Paypal">

      <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
        Bukti Transaksi Pembayaran SMK NEGERI 9 MEDAN. Silahkan Print Halaman ini sebagai Bukti Pembayaran SPP.
      </p>
    </div>
    <!-- /.col -->
    <div class="col-6">
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>Total Pembayaran:</th>
            <td><?= "Rp " . number_format($bayar['jumlah_bayar'], 2, ',', '.') ?></td>
            <td></td>
            <td></td>
          </tr>
        </table>
      </div>
      <div class="float-right">
        <b>TTG Petugas</b>
        <br><br><br><br><br>
        <p><?= session()->get('nama') ?></p>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
  window.addEventListener("load", window.print());
</script>
<?= $this->endSection() ?>